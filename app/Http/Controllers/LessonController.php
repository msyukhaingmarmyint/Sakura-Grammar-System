<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Models\Level;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->only(['index', 'create', 'store', 'update', 'edit', 'changeStatus']);
    }

public function index(Request $request)
{
    $status = $request->status;
    $levelName = $request->level;

    // 1. Base query for calculating dynamic metrics
    // It starts with Lesson, but filters down if a specific level is requested
    $statsQuery = Lesson::query();

    if ($levelName) {
        $statsQuery->whereHas('level', function ($query) use ($levelName) {
            $query->where('name', $levelName);
        });
    }

    // Calculate dynamic counts based strictly on the selected level's footprint
    $totalLessons    = (clone $statsQuery)->count();
    $activeLessons   = (clone $statsQuery)->where('status', 'active')->count();
    $inactiveLessons = (clone $statsQuery)->where('status', 'inactive')->count();

    // 2. Base query for the actual dataset loaded onto the cards
    $lessonsQuery = Lesson::query();

    // Filter by level if one is active in the URL parameter strings
    if ($levelName) {
        $lessonsQuery->whereHas('level', function ($query) use ($levelName) {
            $query->where('name', $levelName);
        });
    }

    // Filter by status if an active/inactive toggle is explicitly set
    if ($status === 'active' || $status === 'inactive') {
        $lessonsQuery->where('status', $status);
    }

    // Finalize the paginated data and ensure query attributes stick around across page clicks
    $lessons = $lessonsQuery->paginate(6)->withQueryString();

    // Static assets for layout lookups
    $levels = Level::all();
    $colors = ['#ff7c9d', '#e9c00a', '#69c03a', '#6e9ce0', '#bd4af3'];

    return view('admin.lesson.index', compact(
        'lessons', 
        'totalLessons', 
        'activeLessons', 
        'inactiveLessons', 
        'levels', 
        'colors'
    ));
}

    public function create()
    {
        $levels = Level::where('status', 'active')->get();
        return view('admin.lesson.create', compact('levels'));
    }

    public function store(LessonRequest $request)
    {
        Lesson::create($request->validated());
        return redirect()->route('lessons.index')->with('success', 'New lesson added successfully!');
    }

    public function edit($id)
    {
        $levels = Level::where('status', 'active')->get();
        $lesson = Lesson::findOrFail($id);
        return view('admin.lesson.update', compact('levels', 'lesson'));
    }

    public function update(LessonRequest $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->validated());

        return redirect()->route('lessons.index')->with('success', 'Updated successfully!');
    }

    public function changeStatus($id)
    {
        $lesson = Lesson::findOrFail($id);

        if ($lesson->status == 'active') {
            $lesson->status = 'inactive';
        } else {
            $lesson->status = 'active';
        }
        $lesson->save();
        return back()->with('success', 'Change status successfully!');
    }

    public function showByLevel(string $name)
    {
        $level = Level::where('name', $name)
            ->where('status', 'active')
            ->firstOrFail();

        $lessons = $level->lessons;
        $allLevels = Level::where('status', 'active')->get();

        $colors = ['#ff7c9d', '#e9c00a', '#69c03a', '#6e9ce0', '#bd4af3',];
        $levelColor = $colors[($level->id - 1) % count($colors)];
        return view('admin.lesson.showByLevel', compact('level', 'lessons', 'allLevels', 'levelColor'));
    }
}
