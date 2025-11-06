<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index(Request $request)
    {
        $query = Course::with('category');

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
            } else {
                $query->where('status', $request->status);
            }
        }

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->byCategory($request->category);
        }

        // Filter by level
        if ($request->has('level') && $request->level !== 'all') {
            $query->byLevel($request->level);
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured === 'true') {
            $query->featured();
        }

        // Filter by bestseller
        if ($request->has('bestseller') && $request->bestseller === 'true') {
            $query->bestseller();
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results
        $courses = $query->paginate(10)->withQueryString();

        // Get stats
        $stats = [
            'total' => Course::count(),
            'published' => Course::published()->count(),
            'draft' => Course::draft()->count(),
            'featured' => Course::featured()->count(),
            'bestseller' => Course::bestseller()->count(),
        ];

        // Get categories for filter
        $categories = CourseCategory::active()->ordered()->get();

        return Inertia::render('Admin/Courses/Index', [
            'courses' => $courses,
            'filters' => [
                'search' => $request->search ?? '',
                'status' => $request->status ?? 'all',
                'category' => $request->category ?? 'all',
                'level' => $request->level ?? 'all',
                'featured' => $request->featured ?? '',
                'bestseller' => $request->bestseller ?? '',
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
            ],
            'stats' => $stats,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new course
     */
    public function create()
    {
        $categories = CourseCategory::active()->ordered()->get();

        return Inertia::render('Admin/Courses/Form', [
            'course' => null,
            'categories' => $categories,
            'isEditing' => false,
        ]);
    }

    /**
     * Store a newly created course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses',
            'course_category_id' => 'required|exists:course_categories,id',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'instructor' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,expert',
            'duration' => 'required|integer|min:1',
            'lessons' => 'required|integer|min:1',
            'language' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'certificate' => 'boolean',
            'bestseller' => 'boolean',
            'featured' => 'boolean',
            'students' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews' => 'nullable|integer|min:0',
            'skills' => 'nullable|array',
            'prerequisites' => 'nullable|array',
            'target_audience' => 'nullable|array',
            'what_you_learn' => 'nullable|array',
            'curriculum' => 'nullable|array',
            'status' => 'required|in:draft,published,archived',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set defaults for nullable fields that shouldn't be null
        $validated['rating'] = $validated['rating'] ?? 0.0;
        $validated['reviews'] = $validated['reviews'] ?? 0;
        $validated['students'] = $validated['students'] ?? 0;

        // Handle publishing
        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['last_updated'] = now();

        $course = Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified course
     */
    public function show(Course $course)
    {
        return Inertia::render('Admin/Courses/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified course
     */
    public function edit(Course $course)
    {
        $course->load('category');
        $categories = CourseCategory::active()->ordered()->get();

        return Inertia::render('Admin/Courses/Form', [
            'course' => $course,
            'categories' => $categories,
            'isEditing' => true,
        ]);
    }

    /**
     * Update the specified course
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses,slug,' . $course->id,
            'course_category_id' => 'required|exists:course_categories,id',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'instructor' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,expert',
            'duration' => 'required|integer|min:1',
            'lessons' => 'required|integer|min:1',
            'language' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'certificate' => 'boolean',
            'bestseller' => 'boolean',
            'featured' => 'boolean',
            'students' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews' => 'nullable|integer|min:0',
            'skills' => 'nullable|array',
            'prerequisites' => 'nullable|array',
            'target_audience' => 'nullable|array',
            'what_you_learn' => 'nullable|array',
            'curriculum' => 'nullable|array',
            'status' => 'required|in:draft,published,archived',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
        ]);

        // Set defaults for nullable fields that shouldn't be null
        $validated['rating'] = $validated['rating'] ?? 0.0;
        $validated['reviews'] = $validated['reviews'] ?? 0;
        $validated['students'] = $validated['students'] ?? 0;

        // Handle publishing
        if ($validated['status'] === 'published' && !$course->published_at && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['last_updated'] = now();

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified course
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully!');
    }

    /**
     * Publish a course
     */
    public function publish(Course $course)
    {
        $course->publish();

        return back()->with('success', 'Course published successfully!');
    }

    /**
     * Unpublish a course (make it draft)
     */
    public function unpublish(Course $course)
    {
        $course->unpublish();

        return back()->with('success', 'Course unpublished successfully!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Course $course)
    {
        $course->update(['featured' => !$course->featured]);

        $message = $course->featured ? 'Course marked as featured!' : 'Course removed from featured!';
        return back()->with('success', $message);
    }

    /**
     * Toggle bestseller status
     */
    public function toggleBestseller(Course $course)
    {
        $course->update(['bestseller' => !$course->bestseller]);

        $message = $course->bestseller ? 'Course marked as bestseller!' : 'Course removed from bestseller!';
        return back()->with('success', $message);
    }

    /**
     * Duplicate a course
     */
    public function duplicate(Course $course)
    {
        $newCourse = $course->replicate();
        $newCourse->title = $course->title . ' (Copy)';
        $newCourse->slug = null; // Will be auto-generated
        $newCourse->status = 'draft';
        $newCourse->published_at = null;
        $newCourse->views = 0;
        $newCourse->students = 0;
        $newCourse->featured = false;
        $newCourse->bestseller = false;
        $newCourse->save();

        return redirect()->route('admin.courses.edit', $newCourse)->with('success', 'Course duplicated successfully!');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,unpublish,delete,feature,unfeature,bestseller,unbestseller',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $courses = Course::whereIn('id', $request->course_ids);

        switch ($request->action) {
            case 'publish':
                $courses->update([
                    'status' => 'published',
                    'published_at' => now(),
                ]);
                $message = 'Courses published successfully!';
                break;

            case 'unpublish':
                $courses->update([
                    'status' => 'draft',
                ]);
                $message = 'Courses unpublished successfully!';
                break;

            case 'feature':
                $courses->update(['featured' => true]);
                $message = 'Courses marked as featured!';
                break;

            case 'unfeature':
                $courses->update(['featured' => false]);
                $message = 'Courses removed from featured!';
                break;

            case 'bestseller':
                $courses->update(['bestseller' => true]);
                $message = 'Courses marked as bestseller!';
                break;

            case 'unbestseller':
                $courses->update(['bestseller' => false]);
                $message = 'Courses removed from bestseller!';
                break;

            case 'delete':
                $courses->delete();
                $message = 'Courses deleted successfully!';
                break;
        }

        return back()->with('success', $message);
    }

}
