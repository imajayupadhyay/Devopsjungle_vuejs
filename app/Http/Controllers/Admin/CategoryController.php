<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            if ($request->status === 'active') {
                $query->active();
            } else {
                $query->where('is_active', false);
            }
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'sort_order');
        $sortOrder = $request->get('sort_order', 'asc');

        if ($sortBy === 'sort_order') {
            $query->ordered();
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Paginate results
        $categories = $query->paginate(15)->withQueryString();

        // Get stats
        $stats = [
            'total' => Category::count(),
            'active' => Category::active()->count(),
            'inactive' => Category::where('is_active', false)->count(),
            'with_posts' => Category::where('posts_count', '>', 0)->count(),
        ];

        return Inertia::render('Admin/Categories/Index', [
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
        return Inertia::render('Admin/Categories/Form', [
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
            'slug' => 'nullable|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category = Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category
     */
    public function show(Category $category)
    {
        $category->load(['blogs' => function ($query) {
            $query->latest()->take(10);
        }]);

        return Inertia::render('Admin/Categories/Show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Form', [
            'category' => $category,
            'isEditing' => true,
        ]);
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category
     */
    public function destroy(Category $category)
    {
        // Check if category has blogs
        if ($category->blogs()->count() > 0) {
            return back()->with('error', 'Cannot delete category with existing blog posts. Please move the posts to another category first.');
        }

        // Delete associated image
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }

    /**
     * Toggle category status
     */
    public function toggleStatus(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        $message = $category->is_active ? 'Category activated!' : 'Category deactivated!';
        return back()->with('success', $message);
    }

    /**
     * Update sort order
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:categories,id',
            'categories.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->categories as $categoryData) {
            Category::where('id', $categoryData['id'])
                   ->update(['sort_order' => $categoryData['sort_order']]);
        }

        return back()->with('success', 'Sort order updated successfully!');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $categories = Category::whereIn('id', $request->category_ids);

        switch ($request->action) {
            case 'activate':
                $categories->update(['is_active' => true]);
                $message = 'Categories activated successfully!';
                break;

            case 'deactivate':
                $categories->update(['is_active' => false]);
                $message = 'Categories deactivated successfully!';
                break;

            case 'delete':
                $categoriesList = $categories->get();

                // Check if any category has blogs
                foreach ($categoriesList as $category) {
                    if ($category->blogs()->count() > 0) {
                        return back()->with('error', 'Cannot delete categories with existing blog posts.');
                    }
                }

                // Delete images and categories
                foreach ($categoriesList as $category) {
                    if ($category->image) {
                        Storage::disk('public')->delete($category->image);
                    }
                }

                $categories->delete();
                $message = 'Categories deleted successfully!';
                break;
        }

        return back()->with('success', $message);
    }
}