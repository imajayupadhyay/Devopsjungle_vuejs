<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs
     */
    public function index()
    {
        // Get published blogs with category and author relationships
        $blogs = Blog::with(['category', 'tags'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->get()
            ->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'excerpt' => $blog->excerpt,
                    'content' => $blog->content,
                    'image' => $blog->featured_image ? Storage::url($blog->featured_image) : 'https://images.unsplash.com/photo-1518186285589-2f7649de83e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'category' => $blog->category->name ?? 'DevOps',
                    'author' => [
                        'name' => $blog->author_name,
                        'avatar' => $blog->author_avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($blog->author_name) . '&background=047857&color=fff'
                    ],
                    'publishedAt' => $blog->published_at ? $blog->published_at->format('M d, Y') : null,
                    'readTime' => $this->calculateReadTime($blog->content),
                    'views' => $blog->views ?? 0,
                ];
            });

        // Get featured blog (most recent featured or most recent published)
        $featuredBlog = Blog::with(['category'])
            ->published()
            ->where('featured', true)
            ->orderBy('published_at', 'desc')
            ->first();

        if (!$featuredBlog) {
            $featuredBlog = Blog::with(['category'])
                ->published()
                ->orderBy('published_at', 'desc')
                ->first();
        }

        $featuredBlogData = null;
        if ($featuredBlog) {
            $featuredBlogData = [
                'id' => $featuredBlog->id,
                'title' => $featuredBlog->title,
                'slug' => $featuredBlog->slug,
                'excerpt' => $featuredBlog->excerpt,
                'image' => $featuredBlog->featured_image ? Storage::url($featuredBlog->featured_image) : 'https://images.unsplash.com/photo-1518186285589-2f7649de83e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'category' => $featuredBlog->category->name ?? 'DevOps',
                'author' => [
                    'name' => $featuredBlog->author_name,
                    'avatar' => $featuredBlog->author_avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($featuredBlog->author_name) . '&background=047857&color=fff'
                ],
                'publishedAt' => $featuredBlog->published_at ? $featuredBlog->published_at->format('M d, Y') : null,
                'readTime' => $this->calculateReadTime($featuredBlog->content),
            ];
        }

        return Inertia::render('Blogs/Index', [
            'blogs' => $blogs,
            'featuredBlog' => $featuredBlogData
        ]);
    }

    /**
     * Display the specified blog
     */
    public function show($slug)
    {
        $blog = Blog::with(['category', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->first();

        if (!$blog) {
            abort(404);
        }

        // Increment views
        $blog->increment('views');

        // Get related blogs (same category, exclude current)
        $relatedBlogs = Blog::with(['category'])
            ->published()
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get()
            ->map(function ($relatedBlog) {
                return [
                    'id' => $relatedBlog->id,
                    'title' => $relatedBlog->title,
                    'slug' => $relatedBlog->slug,
                    'excerpt' => $relatedBlog->excerpt,
                    'image' => $relatedBlog->featured_image ? Storage::url($relatedBlog->featured_image) : 'https://images.unsplash.com/photo-1518186285589-2f7649de83e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'category' => $relatedBlog->category->name ?? 'DevOps',
                    'author' => [
                        'name' => $relatedBlog->author_name,
                        'avatar' => $relatedBlog->author_avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($relatedBlog->author_name) . '&background=047857&color=fff'
                    ],
                    'publishedAt' => $relatedBlog->published_at ? $relatedBlog->published_at->format('M d, Y') : null,
                    'readTime' => $this->calculateReadTime($relatedBlog->content),
                ];
            });

        // If not enough related blogs, fill with other recent blogs
        if ($relatedBlogs->count() < 3) {
            $additionalBlogs = Blog::with(['category'])
                ->published()
                ->where('id', '!=', $blog->id)
                ->whereNotIn('id', $relatedBlogs->pluck('id'))
                ->orderBy('published_at', 'desc')
                ->take(3 - $relatedBlogs->count())
                ->get()
                ->map(function ($additionalBlog) {
                    return [
                        'id' => $additionalBlog->id,
                        'title' => $additionalBlog->title,
                        'slug' => $additionalBlog->slug,
                        'excerpt' => $additionalBlog->excerpt,
                        'image' => $additionalBlog->featured_image ? Storage::url($additionalBlog->featured_image) : 'https://images.unsplash.com/photo-1518186285589-2f7649de83e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'category' => $additionalBlog->category->name ?? 'DevOps',
                        'author' => [
                            'name' => $additionalBlog->author_name,
                            'avatar' => $additionalBlog->author_avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($additionalBlog->author_name) . '&background=047857&color=fff'
                        ],
                        'publishedAt' => $additionalBlog->published_at ? $additionalBlog->published_at->format('M d, Y') : null,
                        'readTime' => $this->calculateReadTime($additionalBlog->content),
                    ];
                });

            $relatedBlogs = $relatedBlogs->concat($additionalBlogs);
        }

        $blogData = [
            'id' => $blog->id,
            'title' => $blog->title,
            'slug' => $blog->slug,
            'excerpt' => $blog->excerpt,
            'content' => $blog->content,
            'image' => $blog->featured_image ? Storage::url($blog->featured_image) : 'https://images.unsplash.com/photo-1518186285589-2f7649de83e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'category' => $blog->category->name ?? 'DevOps',
            'tags' => $blog->tags->pluck('name')->toArray(),
            'author' => [
                'name' => $blog->author_name,
                'avatar' => $blog->author_avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($blog->author_name) . '&background=047857&color=fff',
                'role' => $blog->author_role,
                'bio' => $blog->author_bio,
            ],
            'publishedAt' => $blog->published_at ? $blog->published_at->format('M d, Y') : null,
            'readTime' => $this->calculateReadTime($blog->content),
            'views' => $blog->views ?? 0,
            'meta' => [
                'title' => $blog->meta_title ?: $blog->title,
                'description' => $blog->meta_description ?: $blog->excerpt,
                'keywords' => $blog->meta_keywords,
            ]
        ];

        return Inertia::render('Blogs/Detail', [
            'blog' => $blogData,
            'relatedBlogs' => $relatedBlogs
        ]);
    }

    /**
     * Calculate estimated read time based on content
     */
    private function calculateReadTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $readTime = ceil($wordCount / 200); // Average reading speed: 200 words per minute
        return $readTime . ' min read';
    }
}
