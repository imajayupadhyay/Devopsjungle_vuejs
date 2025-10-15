<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupportController extends Controller
{
    public function index()
    {
        return Inertia::render('Support/Index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'nullable|string|max:20',
            'message' => 'required|string|max:5000',
        ]);

        SupportTicket::create($validated);

        return redirect()->back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}
