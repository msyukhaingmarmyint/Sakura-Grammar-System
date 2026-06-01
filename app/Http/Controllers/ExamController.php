<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\Attempt;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:user'])->only(['showExam', 'storeResult', 'showResult']);

        $this->middleware(['auth', 'role:admin'])->only(['index', 'create', 'store', 'update', 'edit', 'changeStatus']);
    }

public function showExam()
{
    
    $exams = Exam::all()->map(function ($exam) {
        $exam->questions_count = $exam->questions()->count();
        return $exam;
    });
    $colors = ['#ff7c9d', '#e9c00a', '#69c03a', '#6e9ce0', '#bd4af3'];

    return view('admin.exam.showExam', compact('exams', 'colors'));
}

    public function index(Request $request)
    {
        $status = $request->status;

        if ($status == 'active') {
            $exams = Exam::where('status', 'active')->latest()->paginate(6)->withQueryString();
        } elseif ($status == 'inactive') {
            $exams = Exam::where('status', 'inactive')->latest()->paginate(6)->withQueryString();
        } else {
            $exams = Exam::latest()->paginate(6)->withQueryString();
        }

        $totalExams = Exam::count();
        $activeExams = Exam::where('status', 'active')->count();
        $inactiveExams = Exam::where('status', 'inactive')->count();
        return view('admin.exam.index', compact('exams', 'totalExams', 'activeExams', 'inactiveExams'));
    }

    public function create()
    {
        $levels = Level::where('status', 'active')->get();
        return view('admin.exam.create', compact('levels'));
    }

    public function store(ExamRequest $request)
    {
        Exam::create($request->validated());
        return redirect()->route('exams.index')->with('success', 'New exam added successfully!');
    }

    public function edit($id)
    {
        $levels = Level::where('status', 'active')->get();
        $exam = Exam::findOrFail($id);
        return view('admin.exam.update', compact('levels', 'exam'));
    }

    public function update(ExamRequest $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->update($request->validated());

        return redirect()->route('exams.index')->with('success', 'Updated successfully!');
    }

    public function changeStatus($id)
    {
        $exam = Exam::findOrFail($id);

        $status = $exam->status == 'active' ? 'inactive' : 'active';

        $exam->update(['status' => $status]);

        // Update all related questions
        $exam->questions()->update(['status' => $status]);

        return back()->with('success', 'Change status successfully');
    }


public function storeResult(Request $request, $examId)
{
    $exam = Exam::with('questions.options')->findOrFail($examId);

    $userAttempts = Attempt::where('user_id', Auth::id())
        ->where('exam_id', $examId)
        ->count();

    if ($userAttempts >= 3) {
        return back()->with('error', 'You have reached the maximum 3 attempts for this exam.');
    }

    $answers = $request->input('answers', []); 
    $timeTaken = (int) $request->input('time_taken', 0);

    $correctAnswers = 0;
    
    foreach ($exam->questions as $question) {
        if (isset($answers[$question->id])) {
            $selectedOptionId = $answers[$question->id];

            $correctOption = $question->options->firstWhere('is_correct', true);

            if ($correctOption && $selectedOptionId == $correctOption->id) {
                $correctAnswers++;
            }
        }
    }

    $totalQuestions = count($answers) > 0 ? count($answers) : 5;
    
    $mark = $correctAnswers * 10; 
    $status = $mark >= $exam->pass_mark ? 'pass' : 'fail';

Attempt::create([
        'user_id' => Auth::id(),
        'exam_id' => $examId,
        'time_taken' => $timeTaken,
        'attempt_count' => $userAttempts + 1,
        'correct_answers' => $correctAnswers,
        'total_questions' => $totalQuestions,
        'mark' => $mark,
        'status' => $status,
        'user_choices' => $answers 
    ]);

    return redirect()->route('exam.showResult', $examId)
        ->with('success', 'Exam submitted successfully!');
}


    public function showResult($examId)
    {
        $attempt = Attempt::where('user_id', Auth::id())
            ->where('exam_id', $examId)
            ->latest()
            ->firstOrFail();

        $exam = Exam::findOrFail($examId);

        $totalAttempts = Attempt::where('user_id', Auth::id())
            ->where('exam_id', $examId)
            ->count();

        return view('admin.exam.showResult', compact('attempt', 'exam', 'totalAttempts'));
    }

public function reviewAttempt($attemptId)
    {
        $attempt = Attempt::with('exam')->findOrFail($attemptId);
        $exam = $attempt->exam;

        $choices = $attempt->user_choices;
        if (is_string($choices)) {
            $choices = json_decode($choices, true);
        }
        $choices = $choices ?? [];

        $questionIds = array_keys($choices);

        if (empty($questionIds)) {
            $questions = Question::where('exam_id', $exam->id)->with('options')->take(5)->get();
        } else {
            $questions = Question::whereIn('id', $questionIds)
                ->with('options')
                ->get()
                ->sortBy(function ($question) use ($questionIds) {
                    return array_search((string)$question->id, array_map('strval', $questionIds));
                })
                ->values();
        }

        $colors = ['#ff7c9d', '#e9c00a', '#69c03a', '#6e9ce0', '#bd4af3'];
        $levelColor = $colors[($exam->id - 1) % count($colors)];

        return view('admin.exam.review', compact('attempt', 'exam', 'questions', 'levelColor'));
    }
}



