<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\Attempt;
use App\Models\Exam;
use App\Models\Level;
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
        $exams = Exam::all();
        $colors = ['#ff7c9d', '#e9c00a', '#69c03a', '#6e9ce0', '#bd4af3'];
        return view('admin.exam.showExam', compact('exams', 'colors'));
    }

    public function index(Request $request)
    {
        $status = $request->status;

        if ($status == 'active') {
            $exams = Exam::where('status', 'active')->paginate(6);
        } elseif ($status == 'inactive') {
            $exams = Exam::where('status', 'inactive')->paginate(6);
        } else {
            $exams = Exam::paginate(6);
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

        if ($exam->status == 'active') {
            $exam->status = 'inactive';
        } else {
            $exam->status = 'active';
        }
        $exam->save();
        return back()->with('success', 'Change status successfully');
    }

    public function storeResult(Request $request, $examId)
    {
        // Load exam with questions and their options
        $exam = Exam::with('questions.options')->findOrFail($examId);

        // Check user's attempts
        $userAttempts = Attempt::where('user_id', Auth::id())
            ->where('exam_id', $examId)
            ->count();

        if ($userAttempts >= 3) {
            return back()->with('error', 'You have reached the maximum 3 attempts for this exam.');
        }

        $answers = $request->input('answers', []); // answers[question_id] = option_id
        $timeTaken = (int) $request->input('time_taken', 0);

        $totalQuestions = $exam->questions->count();
        $correctAnswers = 0;

        foreach ($exam->questions as $question) {
            if (isset($answers[$question->id])) {
                $selectedOptionId = $answers[$question->id];

                // Find the correct option
                $correctOption = $question->options->firstWhere('is_correct', true);

                if ($correctOption && $selectedOptionId == $correctOption->id) {
                    $correctAnswers++;
                }
            }
        }

        $mark = $correctAnswers * 10; // you can change per question
        $status = $mark >= $exam->pass_mark ? 'pass' : 'fail';

        Attempt::create([
            'user_id' => Auth::id(),
            'exam_id' => $examId,
            'time_taken' => $timeTaken,
            'attempt_count' => $userAttempts + 1,
            'correct_answers' => $correctAnswers,
            'total_questions' => $totalQuestions,
            'mark' => $mark,
            'status' => $status
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
}
