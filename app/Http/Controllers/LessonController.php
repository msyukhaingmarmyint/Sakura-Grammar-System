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
        $this->middleware(['auth', 'role:admin'])->only(['index','create','store','update','edit','changeStatus']);
    }

    public function index(Request $request)
    {
        $status = $request->status;

        if ($status == 'active') {
            $lessons = Lesson::where('status', 'active')->paginate(6);
        } elseif ($status == 'inactive') {
            $lessons = Lesson::where('status', 'inactive')->paginate(6);
        } else {
            $lessons = Lesson::paginate(6);
        }

        $totalLessons = Lesson::count();
        $activeLessons = Lesson::where('status', 'active')->count();
        $inactiveLessons = Lesson::where('status', 'inactive')->count();
        return view('admin.lesson.index', compact('lessons', 'totalLessons', 'activeLessons', 'inactiveLessons'));
    }

    public function create()
    {
        $levels = Level::where('status', 'active')->get();
        return view('admin.lesson.create', compact('levels'));
    }

    public function store(LessonRequest $request)
    {
        Lesson::create($request->validated());
        return redirect()->route('lessons.index')->with('success','New lesson added successfully!');
    }

    public function edit($id)
    {
        $levels = Level::where('status','active')->get();
        $lesson = Lesson::findOrFail($id);
        return view('admin.lesson.update', compact('levels', 'lesson'));
    }

    public function update(LessonRequest $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->validated());

        return redirect()->route('lessons.index')->with('success','Updated successfully!');
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
        return back()->with('success','Change status successfully!');
    }

    public function showByLevel(string $name)
    {
        $level = Level::where('name', $name)->firstOrFail();
        $allLevels = Level::where('status', 'active')->get();
        $lessons = $level->lessons;

        $colors = ['#ff7c9d','#e9c00a','#69c03a','#6e9ce0','#bd4af3',];
        $levelColor = $colors[($level->id - 1 )% count($colors)];
        return view('admin.lesson.showByLevel', compact('level', 'lessons', 'allLevels','levelColor'));
    }
}
