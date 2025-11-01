<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamProvider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ExamProviderController extends Controller
{
    /**
     * Display a listing of exam providers
     */
    public function index(Request $request)
    {
        $query = ExamProvider::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('slug', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('is_active', $request->status === 'active');
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'sort_order');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results with exam dumps count
        $providers = $query->withCount('examDumps')->paginate(15)->withQueryString();

        // Get stats
        $stats = [
            'total' => ExamProvider::count(),
            'active' => ExamProvider::active()->count(),
            'inactive' => ExamProvider::where('is_active', false)->count(),
        ];

        return Inertia::render('Admin/ExamProviders/Index', [
            'providers' => $providers,
            'filters' => [
                'search' => $request->search ?? '',
                'status' => $request->status ?? 'all',
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
            ],
            'stats' => $stats,
        ]);
    }

    /**
     * Show the form for creating a new provider
     */
    public function create()
    {
        return Inertia::render('Admin/ExamProviders/Form', [
            'provider' => null,
            'isEditing' => false,
        ]);
    }

    /**
     * Store a newly created provider
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:exam_providers',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'gradient_color' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        ExamProvider::create($validated);

        return redirect()->route('admin.exam-providers.index')->with('success', 'Exam provider created successfully!');
    }

    /**
     * Display the specified provider
     */
    public function show(ExamProvider $examProvider)
    {
        $examProvider->load(['examDumps' => function($query) {
            $query->latest()->take(10);
        }]);

        return Inertia::render('Admin/ExamProviders/Show', [
            'provider' => $examProvider,
        ]);
    }

    /**
     * Show the form for editing the specified provider
     */
    public function edit(ExamProvider $examProvider)
    {
        return Inertia::render('Admin/ExamProviders/Form', [
            'provider' => $examProvider,
            'isEditing' => true,
        ]);
    }

    /**
     * Update the specified provider
     */
    public function update(Request $request, ExamProvider $examProvider)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:exam_providers,slug,' . $examProvider->id,
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'gradient_color' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $examProvider->update($validated);

        return redirect()->route('admin.exam-providers.index')->with('success', 'Exam provider updated successfully!');
    }

    /**
     * Remove the specified provider
     */
    public function destroy(ExamProvider $examProvider)
    {
        // Check if provider has exam dumps
        if ($examProvider->examDumps()->count() > 0) {
            return back()->with('error', 'Cannot delete provider with existing exam dumps!');
        }

        $examProvider->delete();

        return redirect()->route('admin.exam-providers.index')->with('success', 'Exam provider deleted successfully!');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(ExamProvider $examProvider)
    {
        $examProvider->update(['is_active' => !$examProvider->is_active]);

        $message = $examProvider->is_active ? 'Provider activated!' : 'Provider deactivated!';
        return back()->with('success', $message);
    }

    /**
     * Update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'providers' => 'required|array',
            'providers.*.id' => 'required|exists:exam_providers,id',
            'providers.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->providers as $providerData) {
            ExamProvider::where('id', $providerData['id'])
                ->update(['sort_order' => $providerData['sort_order']]);
        }

        return back()->with('success', 'Sort order updated successfully!');
    }
}
