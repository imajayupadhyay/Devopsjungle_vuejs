<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of course categories
     */
    public function index(Request $request)
    {
        $query = CourseCategory::query();

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

        // Paginate results with courses count
        $categories = $query->withCount('courses')->paginate(15)->withQueryString();

        // Get stats
        $stats = [
            'total' => CourseCategory::count(),
            'active' => CourseCategory::active()->count(),
            'inactive' => CourseCategory::where('is_active', false)->count(),
        ];

        return Inertia::render('Admin/CourseCategories/Index', [
            'categories' => $categories,
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
     * Show the form for creating a new category
     */
    public function create()
    {
        return Inertia::render('Admin/CourseCategories/Form', [
            'category' => null,
            'isEditing' => false,
        ]);
    }

    /**
     * Store a newly created category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:course_categories',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        CourseCategory::create($validated);

        return redirect()->route('admin.course-categories.index')->with('success', 'Course category created successfully!');
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(CourseCategory $courseCategory)
    {
        return Inertia::render('Admin/CourseCategories/Form', [
            'category' => $courseCategory,
            'isEditing' => true,
        ]);
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, CourseCategory $courseCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:course_categories,slug,' . $courseCategory->id,
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $courseCategory->update($validated);

        return redirect()->route('admin.course-categories.index')->with('success', 'Course category updated successfully!');
    }

    /**
     * Remove the specified category
     */
    public function destroy(CourseCategory $courseCategory)
    {
        // Check if category has courses
        if ($courseCategory->courses()->count() > 0) {
            return back()->with('error', 'Cannot delete category with existing courses!');
        }

        $courseCategory->delete();

        return redirect()->route('admin.course-categories.index')->with('success', 'Course category deleted successfully!');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(CourseCategory $courseCategory)
    {
        $courseCategory->update(['is_active' => !$courseCategory->is_active]);

        $message = $courseCategory->is_active ? 'Category activated!' : 'Category deactivated!';
        return back()->with('success', $message);
    }

    /**
     * Update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:course_categories,id',
            'categories.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->categories as $categoryData) {
            CourseCategory::where('id', $categoryData['id'])
                ->update(['sort_order' => $categoryData['sort_order']]);
        }

        return back()->with('success', 'Sort order updated successfully!');
    }
}
