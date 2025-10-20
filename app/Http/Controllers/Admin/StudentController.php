<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the students
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->has('filter') && $request->filter !== 'all') {
            $query->where('status', $request->filter);
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results
        $students = $query->paginate(10)->withQueryString();

        // Add avatar_url to each student
        $students->getCollection()->transform(function ($student) {
            return $student;
        });

        return Inertia::render('Admin/Students/Index', [
            'students' => $students,
            'filters' => [
                'search' => $request->search ?? '',
                'filter' => $request->filter ?? 'all',
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
            ],
            'stats' => [
                'total' => Student::count(),
                'active' => Student::where('status', 'active')->count(),
                'inactive' => Student::where('status', 'inactive')->count(),
                'suspended' => Student::where('status', 'suspended')->count(),
                'recent' => Student::recentlyRegistered(30)->count(),
            ]
        ]);
    }

    /**
     * Store a newly created student
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'status' => 'required|in:active,inactive,suspended',
            'bio' => 'nullable|string|max:1000',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other,prefer_not_to_say',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'timezone' => 'nullable|string|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Student::create($validated);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully!');
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('students')->ignore($student->id)],
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8',
            'status' => 'required|in:active,inactive,suspended',
            'bio' => 'nullable|string|max:1000',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other,prefer_not_to_say',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'timezone' => 'nullable|string|max:50',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $student->update($validated);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully!');
    }

    /**
     * Toggle student status
     */
    public function toggleStatus(Student $student)
    {
        $newStatus = match($student->status) {
            'active' => 'inactive',
            'inactive' => 'active',
            'suspended' => 'active',
            default => 'active',
        };

        $student->update(['status' => $newStatus]);

        return back()->with('success', 'Student status updated successfully!');
    }

    /**
     * Suspend student
     */
    public function suspend(Student $student)
    {
        $student->update(['status' => 'suspended']);

        return back()->with('success', 'Student suspended successfully!');
    }

    /**
     * Activate student
     */
    public function activate(Student $student)
    {
        $student->update(['status' => 'active']);

        return back()->with('success', 'Student activated successfully!');
    }
}
