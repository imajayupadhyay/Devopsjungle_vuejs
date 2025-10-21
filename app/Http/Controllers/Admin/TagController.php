<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    /**
     * Display a listing of tags
     */
    public function index(Request $request)
    {
        $query = Tag::query();

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

        // Filter by popularity
        if ($request->has('filter') && $request->filter === 'popular') {
            $query->where('posts_count', '>', 0)->orderBy('posts_count', 'desc');
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        if ($request->filter !== 'popular') {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Paginate results
        $tags = $query->paginate(20)->withQueryString();

        // Get stats
        $stats = [
            'total' => Tag::count(),
            'active' => Tag::active()->count(),
            'inactive' => Tag::where('is_active', false)->count(),
            'popular' => Tag::where('posts_count', '>', 0)->count(),
        ];

        return Inertia::render('Admin/Tags/Index', [
            'tags' => $tags,
            'filters' => [
                'search' => $request->search ?? '',
                'status' => $request->status ?? 'all',
                'filter' => $request->filter ?? '',
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
            ],
            'stats' => $stats,
        ]);
    }

    /**
     * Show the form for creating a new tag
     */
    public function create()
    {
        return Inertia::render('Admin/Tags/Form', [
            'tag' => null,
            'isEditing' => false,
        ]);
    }

    /**
     * Store a newly created tag
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tags',
            'description' => 'nullable|string',
            'color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
        ]);

        $tag = Tag::create($validated);

        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully!');
    }

    /**
     * Display the specified tag
     */
    public function show(Tag $tag)
    {
        $tag->load(['blogs' => function ($query) {
            $query->latest()->take(10);
        }]);

        return Inertia::render('Admin/Tags/Show', [
            'tag' => $tag,
        ]);
    }

    /**
     * Show the form for editing the specified tag
     */
    public function edit(Tag $tag)
    {
        return Inertia::render('Admin/Tags/Form', [
            'tag' => $tag,
            'isEditing' => true,
        ]);
    }

    /**
     * Update the specified tag
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tags,slug,' . $tag->id,
            'description' => 'nullable|string',
            'color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
        ]);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully!');
    }

    /**
     * Remove the specified tag
     */
    public function destroy(Tag $tag)
    {
        // Check if tag has blogs
        if ($tag->blogs()->count() > 0) {
            return back()->with('error', 'Cannot delete tag with existing blog posts. Please remove the tag from posts first.');
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully!');
    }

    /**
     * Toggle tag status
     */
    public function toggleStatus(Tag $tag)
    {
        $tag->update(['is_active' => !$tag->is_active]);

        $message = $tag->is_active ? 'Tag activated!' : 'Tag deactivated!';
        return back()->with('success', $message);
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $tags = Tag::whereIn('id', $request->tag_ids);

        switch ($request->action) {
            case 'activate':
                $tags->update(['is_active' => true]);
                $message = 'Tags activated successfully!';
                break;

            case 'deactivate':
                $tags->update(['is_active' => false]);
                $message = 'Tags deactivated successfully!';
                break;

            case 'delete':
                $tagsList = $tags->get();

                // Check if any tag has blogs
                foreach ($tagsList as $tag) {
                    if ($tag->blogs()->count() > 0) {
                        return back()->with('error', 'Cannot delete tags with existing blog posts.');
                    }
                }

                $tags->delete();
                $message = 'Tags deleted successfully!';
                break;
        }

        return back()->with('success', $message);
    }

    /**
     * Get popular tags for autocomplete
     */
    public function popular(Request $request)
    {
        $query = Tag::active()->popular(50);

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $tags = $query->get(['id', 'name', 'slug', 'color', 'posts_count']);

        return response()->json($tags);
    }

    /**
     * Search tags for autocomplete
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:1|max:100',
        ]);

        $tags = Tag::active()
            ->where('name', 'like', '%' . $request->q . '%')
            ->orderBy('posts_count', 'desc')
            ->limit(10)
            ->get(['id', 'name', 'slug', 'color']);

        return response()->json($tags);
    }
}