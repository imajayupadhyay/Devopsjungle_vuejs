<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            if ($request->status === 'published') {
                $query->published();
            } elseif ($request->status === 'draft') {
                $query->draft();
            } elseif ($request->status === 'scheduled') {
                $query->scheduled();
            } else {
                $query->where('status', $request->status);
            }
        }

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->category($request->category);
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured === 'true') {
            $query->featured();
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results with relationships
        $blogs = $query->with(['category', 'tags'])->paginate(10)->withQueryString();

        // Transform blog data to include expected structure
        $blogs->getCollection()->transform(function ($blog) {
            $blog->append(['author']);
            $blog->category_name = $blog->category ? $blog->category->name : 'Uncategorized';
            return $blog;
        });

        // Get stats
        $stats = [
            'total' => Blog::count(),
            'published' => Blog::published()->count(),
            'draft' => Blog::draft()->count(),
            'scheduled' => Blog::scheduled()->count(),
            'featured' => Blog::featured()->count(),
        ];

        // Get categories for filter
        $categories = \App\Models\Category::active()->orderBy('name')->pluck('name')->toArray();

        return Inertia::render('Admin/Blogs/Index', [
            'blogs' => $blogs,
            'filters' => [
                'search' => $request->search ?? '',
                'status' => $request->status ?? 'all',
                'category' => $request->category ?? 'all',
                'featured' => $request->featured ?? '',
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
            ],
            'stats' => $stats,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new blog
     */
    public function create()
    {
        $categories = \App\Models\Category::active()->orderBy('name')->get(['id', 'name']);
        $tags = \App\Models\Tag::active()->orderBy('name')->get(['id', 'name']);

        return Inertia::render('Admin/Blogs/Form', [
            'blog' => null,
            'categories' => $categories,
            'tags' => $tags,
            'isEditing' => false,
        ]);
    }

    /**
     * Store a newly created blog
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
            'author_name' => 'required|string|max:255',
            'author_avatar' => 'nullable|url',
            'author_role' => 'nullable|string|max:255',
            'author_bio' => 'nullable|string',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'social_meta' => 'nullable|array',
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'scheduled_at' => 'nullable|date|after:now',
            'featured' => 'boolean',
            'password' => 'nullable|string',
            'comment_status' => 'required|in:open,closed',
            'ping_status' => 'boolean',
            'sticky' => 'boolean',
        ]);

        // Handle file uploads
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs/featured', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('blogs/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryImages;
        }

        // Handle publishing
        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Extract tag_ids before creating the blog
        $tagIds = $validated['tag_ids'] ?? [];
        unset($validated['tag_ids']);

        $blog = Blog::create($validated);

        // Attach tags
        if (!empty($tagIds)) {
            $blog->tags()->attach($tagIds);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified blog
     */
    public function show(Blog $blog)
    {
        return Inertia::render('Admin/Blogs/Show', [
            'blog' => $blog->load('revisions'),
        ]);
    }

    /**
     * Show the form for editing the specified blog
     */
    public function edit(Blog $blog)
    {
        $categories = \App\Models\Category::active()->orderBy('name')->get(['id', 'name']);
        $tags = \App\Models\Tag::active()->orderBy('name')->get(['id', 'name']);

        // Load relationships
        $blog->load(['category', 'tags']);

        return Inertia::render('Admin/Blogs/Form', [
            'blog' => $blog,
            'categories' => $categories,
            'tags' => $tags,
            'isEditing' => true,
        ]);
    }

    /**
     * Update the specified blog
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
            'author_name' => 'required|string|max:255',
            'author_avatar' => 'nullable|url',
            'author_role' => 'nullable|string|max:255',
            'author_bio' => 'nullable|string',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'social_meta' => 'nullable|array',
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
            'status' => 'required|in:draft,published,scheduled,archived',
            'published_at' => 'nullable|date',
            'scheduled_at' => 'nullable|date|after:now',
            'featured' => 'boolean',
            'password' => 'nullable|string',
            'comment_status' => 'required|in:open,closed',
            'ping_status' => 'boolean',
            'sticky' => 'boolean',
        ]);

        // Handle file uploads
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blogs/featured', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images
            if ($blog->gallery_images) {
                foreach ($blog->gallery_images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('blogs/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryImages;
        }

        // Handle publishing
        if ($validated['status'] === 'published' && !$blog->published_at && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Extract tag_ids before updating the blog
        $tagIds = $validated['tag_ids'] ?? [];
        unset($validated['tag_ids']);

        $blog->update($validated);

        // Sync tags
        $blog->tags()->sync($tagIds);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified blog
     */
    public function destroy(Blog $blog)
    {
        // Delete associated files
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        if ($blog->gallery_images) {
            foreach ($blog->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }

    /**
     * Publish a blog
     */
    public function publish(Blog $blog)
    {
        $blog->publish();

        return back()->with('success', 'Blog published successfully!');
    }

    /**
     * Unpublish a blog (make it draft)
     */
    public function unpublish(Blog $blog)
    {
        $blog->unpublish();

        return back()->with('success', 'Blog unpublished successfully!');
    }

    /**
     * Schedule a blog
     */
    public function schedule(Request $request, Blog $blog)
    {
        $request->validate([
            'scheduled_at' => 'required|date|after:now',
        ]);

        $blog->schedule(Carbon::parse($request->scheduled_at));

        return back()->with('success', 'Blog scheduled successfully!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Blog $blog)
    {
        $blog->update(['featured' => !$blog->featured]);

        $message = $blog->featured ? 'Blog marked as featured!' : 'Blog removed from featured!';
        return back()->with('success', $message);
    }

    /**
     * Duplicate a blog
     */
    public function duplicate(Blog $blog)
    {
        $newBlog = $blog->replicate();
        $newBlog->title = $blog->title . ' (Copy)';
        $newBlog->slug = null; // Will be auto-generated
        $newBlog->status = 'draft';
        $newBlog->published_at = null;
        $newBlog->scheduled_at = null;
        $newBlog->views = 0;
        $newBlog->featured = false;
        $newBlog->save();

        return redirect()->route('admin.blogs.edit', $newBlog)->with('success', 'Blog duplicated successfully!');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,unpublish,delete,feature,unfeature',
            'blog_ids' => 'required|array',
            'blog_ids.*' => 'exists:blogs,id',
        ]);

        $blogs = Blog::whereIn('id', $request->blog_ids);

        switch ($request->action) {
            case 'publish':
                $blogs->update([
                    'status' => 'published',
                    'published_at' => now(),
                ]);
                $message = 'Blogs published successfully!';
                break;

            case 'unpublish':
                $blogs->update([
                    'status' => 'draft',
                    'published_at' => null,
                ]);
                $message = 'Blogs unpublished successfully!';
                break;

            case 'feature':
                $blogs->update(['featured' => true]);
                $message = 'Blogs marked as featured!';
                break;

            case 'unfeature':
                $blogs->update(['featured' => false]);
                $message = 'Blogs removed from featured!';
                break;

            case 'delete':
                $blogsList = $blogs->get();
                foreach ($blogsList as $blog) {
                    // Delete associated files
                    if ($blog->featured_image) {
                        Storage::disk('public')->delete($blog->featured_image);
                    }
                    if ($blog->gallery_images) {
                        foreach ($blog->gallery_images as $image) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }
                $blogs->delete();
                $message = 'Blogs deleted successfully!';
                break;
        }

        return back()->with('success', $message);
    }
}