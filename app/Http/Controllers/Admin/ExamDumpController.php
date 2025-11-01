<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamDump;
use App\Models\ExamProvider;
use App\Models\ExamTopic;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExamDumpController extends Controller
{
    /**
     * Display a listing of exam dumps
     */
    public function index(Request $request)
    {
        $query = ExamDump::query()->with(['provider', 'topics']);

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

        // Filter by provider
        if ($request->has('provider') && $request->provider !== 'all') {
            $query->byProvider($request->provider);
        }

        // Filter by difficulty
        if ($request->has('difficulty') && $request->difficulty !== 'all') {
            $query->byDifficulty($request->difficulty);
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured === 'true') {
            $query->featured();
        }

        // Filter by free/paid
        if ($request->has('pricing') && $request->pricing !== 'all') {
            if ($request->pricing === 'free') {
                $query->free();
            } else {
                $query->where('is_free', false);
            }
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results
        $examDumps = $query->paginate(10)->withQueryString();

        // Get stats
        $stats = [
            'total' => ExamDump::count(),
            'published' => ExamDump::published()->count(),
            'draft' => ExamDump::draft()->count(),
            'featured' => ExamDump::featured()->count(),
            'free' => ExamDump::free()->count(),
        ];

        // Get providers for filter
        $providers = ExamProvider::active()->ordered()->get(['id', 'name']);

        return Inertia::render('Admin/ExamDumps/Index', [
            'examDumps' => $examDumps,
            'filters' => [
                'search' => $request->search ?? '',
                'status' => $request->status ?? 'all',
                'provider' => $request->provider ?? 'all',
                'difficulty' => $request->difficulty ?? 'all',
                'featured' => $request->featured ?? '',
                'pricing' => $request->pricing ?? 'all',
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
            ],
            'stats' => $stats,
            'providers' => $providers,
        ]);
    }

    /**
     * Show the form for creating a new exam dump
     */
    public function create()
    {
        $providers = ExamProvider::active()->ordered()->get(['id', 'name', 'slug']);
        $topics = ExamTopic::active()->get(['id', 'name']);

        return Inertia::render('Admin/ExamDumps/Form', [
            'examDump' => null,
            'providers' => $providers,
            'topics' => $topics,
            'isEditing' => false,
        ]);
    }

    /**
     * Store a newly created exam dump
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:exam_dumps',
            'slug' => 'nullable|string|max:255|unique:exam_dumps',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'exam_provider_id' => 'required|exists:exam_providers,id',
            'difficulty' => 'required|in:beginner,intermediate,expert',
            'questions_count' => 'required|integer|min:1',
            'duration_minutes' => 'required|integer|min:1',
            'passing_score' => 'required|integer|min:0|max:1000',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'is_free' => 'boolean',
            'success_rate' => 'nullable|integer|min:0|max:100',
            'popularity' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:draft,published,archived',
            'featured' => 'boolean',
            'badge' => 'nullable|string|max:50',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'sample_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'prerequisites' => 'nullable|array',
            'target_audience' => 'nullable|array',
            'what_you_learn' => 'nullable|array',
            'topic_ids' => 'nullable|array',
            'topic_ids.*' => 'exists:exam_topics,id',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('exam-dumps/pdfs', 'public');
        }

        if ($request->hasFile('sample_pdf')) {
            $validated['sample_pdf'] = $request->file('sample_pdf')->store('exam-dumps/samples', 'public');
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['code']);
        }

        // Handle publishing
        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['last_updated_at'] = now();

        // Extract topic_ids before creating
        $topicIds = $validated['topic_ids'] ?? [];
        unset($validated['topic_ids']);

        $examDump = ExamDump::create($validated);

        // Attach topics
        if (!empty($topicIds)) {
            $examDump->topics()->attach($topicIds);
        }

        return redirect()->route('admin.exam-dumps.index')->with('success', 'Exam dump created successfully!');
    }

    /**
     * Display the specified exam dump
     */
    public function show(ExamDump $examDump)
    {
        $examDump->load(['provider', 'topics', 'questions', 'reviews', 'faqs']);

        return Inertia::render('Admin/ExamDumps/Show', [
            'examDump' => $examDump,
        ]);
    }

    /**
     * Show the form for editing the specified exam dump
     */
    public function edit(ExamDump $examDump)
    {
        $providers = ExamProvider::active()->ordered()->get(['id', 'name', 'slug']);
        $topics = ExamTopic::active()->get(['id', 'name']);

        // Load relationships
        $examDump->load(['provider', 'topics']);

        return Inertia::render('Admin/ExamDumps/Form', [
            'examDump' => $examDump,
            'providers' => $providers,
            'topics' => $topics,
            'isEditing' => true,
        ]);
    }

    /**
     * Update the specified exam dump
     */
    public function update(Request $request, ExamDump $examDump)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:exam_dumps,code,' . $examDump->id,
            'slug' => 'nullable|string|max:255|unique:exam_dumps,slug,' . $examDump->id,
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'exam_provider_id' => 'required|exists:exam_providers,id',
            'difficulty' => 'required|in:beginner,intermediate,expert',
            'questions_count' => 'required|integer|min:1',
            'duration_minutes' => 'required|integer|min:1',
            'passing_score' => 'required|integer|min:0|max:1000',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'is_free' => 'boolean',
            'success_rate' => 'nullable|integer|min:0|max:100',
            'popularity' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:draft,published,archived',
            'featured' => 'boolean',
            'badge' => 'nullable|string|max:50',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'sample_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'prerequisites' => 'nullable|array',
            'target_audience' => 'nullable|array',
            'what_you_learn' => 'nullable|array',
            'topic_ids' => 'nullable|array',
            'topic_ids.*' => 'exists:exam_topics,id',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('pdf_file')) {
            // Delete old file
            if ($examDump->pdf_file) {
                Storage::disk('public')->delete($examDump->pdf_file);
            }
            $validated['pdf_file'] = $request->file('pdf_file')->store('exam-dumps/pdfs', 'public');
        }

        if ($request->hasFile('sample_pdf')) {
            // Delete old file
            if ($examDump->sample_pdf) {
                Storage::disk('public')->delete($examDump->sample_pdf);
            }
            $validated['sample_pdf'] = $request->file('sample_pdf')->store('exam-dumps/samples', 'public');
        }

        // Handle publishing
        if ($validated['status'] === 'published' && !$examDump->published_at && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['last_updated_at'] = now();

        // Extract topic_ids before updating
        $topicIds = $validated['topic_ids'] ?? [];
        unset($validated['topic_ids']);

        $examDump->update($validated);

        // Sync topics
        $examDump->topics()->sync($topicIds);

        return redirect()->route('admin.exam-dumps.index')->with('success', 'Exam dump updated successfully!');
    }

    /**
     * Remove the specified exam dump
     */
    public function destroy(ExamDump $examDump)
    {
        // Delete associated files
        if ($examDump->pdf_file) {
            Storage::disk('public')->delete($examDump->pdf_file);
        }

        if ($examDump->sample_pdf) {
            Storage::disk('public')->delete($examDump->sample_pdf);
        }

        $examDump->delete();

        return redirect()->route('admin.exam-dumps.index')->with('success', 'Exam dump deleted successfully!');
    }

    /**
     * Publish an exam dump
     */
    public function publish(ExamDump $examDump)
    {
        $examDump->publish();

        return back()->with('success', 'Exam dump published successfully!');
    }

    /**
     * Unpublish an exam dump (make it draft)
     */
    public function unpublish(ExamDump $examDump)
    {
        $examDump->unpublish();

        return back()->with('success', 'Exam dump unpublished successfully!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(ExamDump $examDump)
    {
        $examDump->update(['featured' => !$examDump->featured]);

        $message = $examDump->featured ? 'Exam dump marked as featured!' : 'Exam dump removed from featured!';
        return back()->with('success', $message);
    }

    /**
     * Duplicate an exam dump
     */
    public function duplicate(ExamDump $examDump)
    {
        $newExamDump = $examDump->replicate();
        $newExamDump->title = $examDump->title . ' (Copy)';
        $newExamDump->code = $examDump->code . '-copy';
        $newExamDump->slug = null; // Will be auto-generated
        $newExamDump->status = 'draft';
        $newExamDump->published_at = null;
        $newExamDump->views = 0;
        $newExamDump->downloads = 0;
        $newExamDump->featured = false;
        $newExamDump->save();

        // Copy topics
        $examDump->topics->each(function ($topic) use ($newExamDump) {
            $newExamDump->topics()->attach($topic->id);
        });

        return redirect()->route('admin.exam-dumps.edit', $newExamDump)->with('success', 'Exam dump duplicated successfully!');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,unpublish,delete,feature,unfeature',
            'exam_dump_ids' => 'required|array',
            'exam_dump_ids.*' => 'exists:exam_dumps,id',
        ]);

        $examDumps = ExamDump::whereIn('id', $request->exam_dump_ids);

        switch ($request->action) {
            case 'publish':
                $examDumps->update([
                    'status' => 'published',
                    'published_at' => now(),
                ]);
                $message = 'Exam dumps published successfully!';
                break;

            case 'unpublish':
                $examDumps->update([
                    'status' => 'draft',
                ]);
                $message = 'Exam dumps unpublished successfully!';
                break;

            case 'feature':
                $examDumps->update(['featured' => true]);
                $message = 'Exam dumps marked as featured!';
                break;

            case 'unfeature':
                $examDumps->update(['featured' => false]);
                $message = 'Exam dumps removed from featured!';
                break;

            case 'delete':
                $examDumpsList = $examDumps->get();
                foreach ($examDumpsList as $dump) {
                    // Delete associated files
                    if ($dump->pdf_file) {
                        Storage::disk('public')->delete($dump->pdf_file);
                    }
                    if ($dump->sample_pdf) {
                        Storage::disk('public')->delete($dump->sample_pdf);
                    }
                }
                $examDumps->delete();
                $message = 'Exam dumps deleted successfully!';
                break;
        }

        return back()->with('success', $message);
    }
}
