<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index(Request $request)
    {
        $query = Course::with('category')
            ->where('status', 'published');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%")
                  ->orWhere('instructor', 'like', "%{$request->search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by level
        if ($request->has('level') && $request->level !== 'all') {
            $query->where('level', $request->level);
        }

        // Sort functionality
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Get paginated courses
        $courses = $query->paginate(9);

        // Transform courses for frontend
        $courses->getCollection()->transform(function ($course) {
            return [
                'id' => $course->slug,
                'title' => $course->title,
                'category' => $course->category ? $course->category->slug : 'general',
                'categoryName' => $course->category ? $course->category->name : 'General',
                'categoryIcon' => $course->category ? $course->category->icon : 'fas fa-graduation-cap',
                'categoryColor' => $course->category ? $course->category->color : '#047857',
                'level' => $course->level,
                'instructor' => $course->instructor,
                'description' => $course->description,
                'duration' => $course->duration,
                'lessons' => $course->lessons,
                'students' => $course->students,
                'rating' => $course->rating,
                'reviews' => $course->reviews,
                'price' => $course->price,
                'originalPrice' => $course->original_price,
                'language' => $course->language,
                'certificate' => $course->certificate,
                'bestseller' => $course->bestseller,
                'featured' => $course->featured,
                'lastUpdated' => $course->last_updated ? $course->last_updated->format('Y-m-d') : null,
                'skills' => $course->skills ?? [],
            ];
        });

        // Get categories for filter
        $categories = CourseCategory::active()
            ->ordered()
            ->withCount(['courses' => function($query) {
                $query->where('status', 'published');
            }])
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->slug,
                    'slug' => $category->slug,
                    'name' => $category->name,
                    'icon' => $category->icon,
                    'count' => $category->courses_count,
                ];
            });

        // Get total published courses count
        $totalCoursesCount = Course::where('status', 'published')->count();

        // Add "All" option
        $categories->prepend([
            'id' => 'all',
            'slug' => 'all',
            'name' => 'All Categories',
            'icon' => 'fas fa-th-large',
            'count' => $totalCoursesCount,
        ]);

        // Get levels
        $levels = [
            ['id' => 'all', 'name' => 'All Levels'],
            ['id' => 'beginner', 'name' => 'Beginner'],
            ['id' => 'intermediate', 'name' => 'Intermediate'],
            ['id' => 'advanced', 'name' => 'Advanced'],
            ['id' => 'expert', 'name' => 'Expert'],
        ];

        // Get featured courses
        $featuredCourses = Course::with('category')
            ->where('status', 'published')
            ->where('featured', true)
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->slug,
                    'title' => $course->title,
                    'category' => $course->category ? $course->category->slug : 'general',
                    'categoryName' => $course->category ? $course->category->name : 'General',
                    'categoryIcon' => $course->category ? $course->category->icon : 'fas fa-graduation-cap',
                    'categoryColor' => $course->category ? $course->category->color : '#047857',
                    'instructor' => $course->instructor,
                    'description' => $course->description,
                    'duration' => $course->duration,
                    'students' => $course->students,
                    'rating' => $course->rating,
                    'price' => $course->price,
                    'originalPrice' => $course->original_price,
                    'bestseller' => $course->bestseller,
                    'featured' => $course->featured,
                ];
            });

        // Get bestseller courses
        $bestsellerCourses = Course::with('category')
            ->where('status', 'published')
            ->where('bestseller', true)
            ->orderBy('students', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->slug,
                    'title' => $course->title,
                    'category' => $course->category ? $course->category->slug : 'general',
                    'categoryName' => $course->category ? $course->category->name : 'General',
                    'price' => $course->price,
                    'originalPrice' => $course->original_price,
                    'students' => $course->students,
                    'rating' => $course->rating,
                ];
            });

        return Inertia::render('Courses/Index', [
            'courses' => $courses->items(),
            'pagination' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'total' => $courses->total(),
            ],
            'categories' => $categories,
            'levels' => $levels,
            'featuredCourses' => $featuredCourses,
            'bestsellerCourses' => $bestsellerCourses,
            'filters' => [
                'search' => $request->search ?? '',
                'category' => $request->category ?? 'all',
                'level' => $request->level ?? 'all',
                'sort' => $sortBy,
                'order' => $sortOrder,
            ],
        ]);
    }

    /**
     * Display the specified course
     */
    public function show($slug)
    {
        $course = Course::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Get related courses (same category, excluding current)
        $relatedCourses = Course::with('category')
            ->where('status', 'published')
            ->where('course_category_id', $course->course_category_id)
            ->where('id', '!=', $course->id)
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($relatedCourse) {
                return [
                    'id' => $relatedCourse->slug,
                    'title' => $relatedCourse->title,
                    'category' => $relatedCourse->category ? $relatedCourse->category->slug : 'general',
                    'instructor' => $relatedCourse->instructor,
                    'duration' => $relatedCourse->duration,
                    'students' => $relatedCourse->students,
                    'rating' => $relatedCourse->rating,
                    'price' => $relatedCourse->price,
                    'originalPrice' => $relatedCourse->original_price,
                ];
            });

        // Transform course for frontend
        $courseData = [
            'id' => $course->slug,
            'title' => $course->title,
            'category' => $course->category ? $course->category->slug : 'general',
            'categoryName' => $course->category ? $course->category->name : 'General',
            'categoryIcon' => $course->category ? $course->category->icon : 'fas fa-graduation-cap',
            'categoryColor' => $course->category ? $course->category->color : '#047857',
            'level' => $course->level,
            'instructor' => $course->instructor,
            'description' => $course->description,
            'full_description' => $course->full_description,
            'duration' => $course->duration,
            'lessons' => $course->lessons,
            'students' => $course->students,
            'rating' => $course->rating,
            'reviews' => $course->reviews,
            'price' => $course->price,
            'originalPrice' => $course->original_price,
            'language' => $course->language,
            'certificate' => $course->certificate,
            'bestseller' => $course->bestseller,
            'featured' => $course->featured,
            'lastUpdated' => $course->last_updated ? $course->last_updated->format('Y-m-d') : null,
            'skills' => $course->skills ?? [],
            'prerequisites' => $course->prerequisites ?? [],
            'target_audience' => $course->target_audience ?? [],
            'what_you_learn' => $course->what_you_learn ?? [],
            'curriculum' => $course->curriculum ?? [],
        ];

        return Inertia::render('Courses/Detail', [
            'course' => $courseData,
            'relatedCourses' => $relatedCourses,
        ]);
    }

    /**
     * Get featured courses for homepage
     */
    public function getFeaturedCourses()
    {
        $featuredCourses = Course::with('category')
            ->where('status', 'published')
            ->where('featured', true)
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->slug,
                    'title' => $course->title,
                    'category' => $course->category ? $course->category->slug : 'general',
                    'categoryName' => $course->category ? $course->category->name : 'General',
                    'categoryIcon' => $course->category ? $course->category->icon : 'fas fa-graduation-cap',
                    'categoryColor' => $course->category ? $course->category->color : '#047857',
                    'instructor' => $course->instructor,
                    'description' => $course->description,
                    'duration' => $course->duration,
                    'students' => $course->students,
                    'rating' => $course->rating,
                    'price' => $course->price,
                    'originalPrice' => $course->original_price,
                ];
            });

        return $featuredCourses;
    }
}
