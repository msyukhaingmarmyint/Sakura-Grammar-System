<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Attempt;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:user'])->only(['showByExam']);

        $this->middleware(['auth', 'role:admin'])->only(['index', 'create', 'store', 'update', 'edit', 'destroy', 'changeStatus']);
    }

    public function index(Request $request)
    {
        $status = $request->status;
        $levelName = $request->level;

        $questions = Question::query();

        if ($status == 'active') {
            $questions->where('status', 'active');
        } elseif ($status == 'inactive') {
            $questions->where('status', 'inactive');
        }

        if ($levelName) {

            $level = Level::where('name', $levelName)->first();

            if ($level && $level->exam) {
                $questions->where('exam_id', $level->exam->id);
            }
        }

        $questions = $questions->paginate(6);
        $questions = $questions->appends($request->except('page'));

        $totalQuestions = Question::count();
        $activeQuestions = Question::where('status', 'active')->count();
        $inactiveQuestions = Question::where('status', 'inactive')->count();
        $levels = Level::all();
        $colors = ['#ff7c9d', '#e9c00a', '#69c03a', '#6e9ce0', '#bd4af3'];

        return view('admin.question.index', compact(
            'questions',
            'totalQuestions',
            'activeQuestions',
            'inactiveQuestions',
            'levels',
            'colors'
        ));
    }

    public function create()
    {
        $exams = Exam::where('status', 'active')->get();
        return view('admin.question.create', compact('exams'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|unique:questions,question',
            'options' => 'required|array|min:2',
            'options.*' => 'required',
            'correct_option' => 'required',
            'exam_id' => 'required'
        ], [
            'question.unique' => 'This question is already existed.',
            'question.required' => 'Question  is required.',
            'options.*.required' => 'Options are required!',
            'correct_option.required' => 'Correct option  is required.',
            'exam_id.required' => 'Exam id is required!',
        ]);

        $question = Question::create([
            'question' => $request->question,
            'exam_id' => $request->exam_id,
            'status' => 'active'
        ]);

        foreach ($request->options as $index => $optionText) {
            $question->options()->create([
                'option_text' => $optionText,
                'is_correct' => $request->correct_option == $index
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'New Question added successfully!');
    }

    public function edit($id)
    {
        $exams = Exam::where('status', 'active')->get();
        $question = Question::findOrFail($id);
        return view('admin.question.update', compact('exams', 'question'));
    }


    public function update(Request $request, $id)
    {
        $question = Question::with('options')->findOrFail($id);


        $request->validate([
            'question' => 'required',
            'options' => 'required|array|min:2',
            'options.*' => 'required',
            'correct_option' => 'required',
            'exam_id' => 'required'
        ]);

        $question->update([
            'question' => $request->question,
            'exam_id' => $request->exam_id
        ]);

        $question->options()->delete();

        foreach ($request->options as $index => $optionText) {
            $question->options()->create([
                'option_text' => $optionText,
                'is_correct' => $request->correct_option == $index
            ]);
        }

        return redirect()->route('questions.index')
            ->with('success', 'Updated successfully!');
    }

    public function changeStatus($id)
    {
        $question = Question::findOrFail($id);

        if ($question->status == 'active') {
            $question->status = 'inactive';
        } else {
            $question->status = 'active';
        }
        $question->save();
        return back()->with('success', 'Change status successfully!');
    }

    public function showByExam($id)
    {
        $exam = Exam::findOrFail($id);
        $userId = Auth::id();

        $userAttempts = Attempt::where('user_id', $userId)
            ->where('exam_id', $id)
            ->count();

        if ($userAttempts >= 3) {
            return redirect()->route('exam.index')
                ->with('error', 'You have reached maximum 3 attempts for this exam.');
        }

        $questions = Question::where('exam_id', $id)->inRandomOrder()->limit(5)->get();
        $colors = ['#ff7c9d', '#e9c00a', '#69c03a', '#6e9ce0', '#bd4af3',];
        $levelColor = $colors[($exam->id - 1) % count($colors)];
        return view('admin.question.showByExam', compact('exam', 'questions', 'levelColor'));
    }
}
