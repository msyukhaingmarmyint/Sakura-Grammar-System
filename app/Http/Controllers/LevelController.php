<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelRequest;
use App\Models\Exam;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->only(['index', 'create', 'store', 'update', 'edit', 'destroy', 'changeStatus']);
    }

    public function index(Request $request)
    {
        $status = $request->status;

        if ($status == 'active') {
            $levels = Level::where('status', 'active')->paginate(6)->withQueryString();
        } elseif ($status == 'inactive') {
            $levels = Level::where('status', 'inactive')->paginate(6)->withQueryString();
        } else {
            $levels = Level::paginate(6)->withQueryString();
        }

        $totalLevels = Level::count();
        $activeLevels = Level::where('status', 'active')->count();
        $inactiveLevels = Level::where('status', 'inactive')->count();
        return view('admin.level.index', compact('levels', 'totalLevels', 'activeLevels', 'inactiveLevels'));
    }


    public function create()
    {
        return view('admin.level.create');
    }

    public function store(LevelRequest $request)
    {
        Level::create($request->validated());
        return redirect()->route('levels.index')->with('success', 'New level added successfully!');
    }

    public function edit($id)
    {
        $level = Level::findOrFail($id);
        return view('admin.level.update', compact('level'));
    }

    public function update(LevelRequest $request, $id)
    {
        $level = Level::findOrFail($id);
        $level->update($request->validated());

        return redirect()->route('levels.index')->with('success', 'Updated successfully');
    }

    public function changeStatus($id)
    {
        $level = Level::findOrFail($id);

        $status = $level->status == 'active' ? 'inactive' : 'active';

        // Level
        $level->update(['status' => $status]);

        // Lessons
        $level->lessons()->update(['status' => $status]);

        // Exam + Questions
        if ($level->exam) {

            $level->exam->update([
                'status' => $status
            ]);

            $level->exam->questions()->update([
                'status' => $status
            ]);
        }

        return back()->with('success', 'Change status successfully!');
    }
}
