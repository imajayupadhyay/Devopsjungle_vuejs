<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\DataProviders\BlogsDataProvider;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs
     */
    public function index()
    {
        $blogs = BlogsDataProvider::getBlogs();
        $featuredBlog = BlogsDataProvider::getFeaturedBlog();

        return Inertia::render('Blogs/Index', [
            'blogs' => $blogs,
            'featuredBlog' => $featuredBlog
        ]);
    }

    /**
     * Display the specified blog
     */
    public function show($slug)
    {
        $blog = BlogsDataProvider::getBlogBySlug($slug);

        if (!$blog) {
            abort(404);
        }

        // Get related blogs (same category, exclude current)
        $relatedBlogs = collect(BlogsDataProvider::getBlogs())
            ->where('category', $blog['category'])
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values()
            ->toArray();

        // If not enough related blogs, fill with other blogs
        if (count($relatedBlogs) < 3) {
            $additionalBlogs = collect(BlogsDataProvider::getBlogs())
                ->where('slug', '!=', $slug)
                ->whereNotIn('slug', collect($relatedBlogs)->pluck('slug'))
                ->take(3 - count($relatedBlogs))
                ->values()
                ->toArray();

            $relatedBlogs = array_merge($relatedBlogs, $additionalBlogs);
        }

        return Inertia::render('Blogs/Detail', [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs
        ]);
    }
}
