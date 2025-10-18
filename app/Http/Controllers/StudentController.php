<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'phone' => 'required|string|regex:/^[\+]?[1-9][\d]{0,15}$/',
            'password' => ['required', Password::min(8)],
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Automatically log in the newly registered user
        Auth::login($student);
        $request->session()->regenerate();

        return redirect()->back()->with('success', 'Account created and logged in successfully!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => strtolower($request->email),
            'password' => $request->password,
        ];

        // Debug: Check if user exists
        $student = Student::where('email', $credentials['email'])->first();
        if (!$student) {
            return back()->withErrors([
                'general' => 'No account found with this email address.',
            ])->withInput($request->except('password'));
        }

        // Debug: Check password
        if (!Hash::check($credentials['password'], $student->password)) {
            return back()->withErrors([
                'general' => 'The password you entered is incorrect.',
            ])->withInput($request->except('password'));
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $student = Auth::user();
            $student->updateLastLogin();

            return redirect()->back()->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'general' => 'Authentication failed. Please try again.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back()->with('success', 'Logged out successfully!');
    }

    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'Please login to access your profile.');
        }

        return Inertia::render('Profile/Index', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'date_of_birth' => $user->date_of_birth,
                'gender' => $user->gender,
                'country' => $user->country,
                'city' => $user->city,
                'timezone' => $user->timezone,
                'bio' => $user->bio,
                'avatar_url' => $user->avatar_url,
                'initials' => $user->initials,
                'created_at' => $user->created_at,
                'status' => $user->status,
            ]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'Please login to access your profile.');
        }

        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $user->id,
            'phone' => 'nullable|string|regex:/^[\+]?[1-9][\d]{0,15}$/',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other,prefer_not_to_say',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:50',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'country' => $request->country,
            'city' => $request->city,
            'timezone' => $request->timezone ?: 'UTC',
            'bio' => $request->bio,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function uploadAvatar(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'Please login to access your profile.');
        }

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,jpg,png,gif|max:5120', // 5MB max
        ]);

        try {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            // Update user avatar path
            $user->update(['avatar' => $avatarPath]);

            return redirect()->back()->with('success', 'Profile picture updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors([
                'avatar' => 'Failed to upload avatar. Please try again.',
            ]);
        }
    }
}