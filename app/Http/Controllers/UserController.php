<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Certificate;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\CertificateMail;
use App\Models\ReactivationRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['userStatus', 'edit', 'update', 'changeStatus', 'showChangePassword', 'changePassword']);

        $this->middleware(['auth', 'role:user'])->only(['showTakenExams', 'showTakenCertificates', 'getCerfificate']);

        $this->middleware(['auth', 'role:admin'])->only(['index', 'destroy', 'showScore']);
    }

    public function index(Request $request)
    {
        $status = $request->status;

        if ($status == 'active') {
            $users = User::where('status', 'active')->where('role', 'user')->paginate(5)->withQueryString();
        } elseif ($status == 'inactive') {
            $users = User::where('status', 'inactive')->where('role', 'user')->paginate(5)->withQueryString();
        } else {
            $users = User::where('role', 'user')->paginate(5)->withQueryString();
        }

        $totalUsers = User::where('role', 'user')->count();
        $activeUsers = User::where('status', 'active')->where('role', 'user')->count();
        $inactiveUsers = User::where('status', 'inactive')->where('role', 'user')->count();
        return view('admin.user.index', compact('users', 'totalUsers', 'activeUsers', 'inactiveUsers'));
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile.index', compact('user'));
    }

    public function showTakenExams($id)
    {
        $attempts = Attempt::where('user_id', $id)->paginate(6);
        $colors = ['#ff7c9d', '#e9c00a', '#69c03a', '#6e9ce0', '#bd4af3'];
        return view('user.taken_exams', compact('attempts', 'colors'));
    }

    public function showTakenCertificates($id)
    {
        $attemptIds = Attempt::where('user_id', $id)->pluck('id');
        $certificates = Certificate::whereIn('attempt_id', $attemptIds)->paginate(2);
        return view('user.certificates', compact('certificates'));
    }

    public function showScore(Request $request)
    {
        $exam = $request->exam;

        if ($exam == '1') {
            $certificates = Certificate::whereHas('attempt', function ($query) {
                $query->where('exam_id', 1);
            })->paginate(6)->withQueryString();
        } elseif ($exam == '2') {
            $certificates = Certificate::whereHas('attempt', function ($query) {
                $query->where('exam_id', 2);
            })->paginate(6)->withQueryString();
        } elseif ($exam == '3') {
            $certificates = Certificate::whereHas('attempt', function ($query) {
                $query->where('exam_id', 3);
            })->paginate(6)->withQueryString();
        } elseif ($exam == '4') {
            $certificates = Certificate::whereHas('attempt', function ($query) {
                $query->where('exam_id', 4);
            })->paginate(6)->withQueryString();
        } elseif ($exam == '5') {
            $certificates = Certificate::whereHas('attempt', function ($query) {
                $query->where('exam_id', 5);
            })->paginate(6)->withQueryString();
        } else {
            $certificates = Certificate::paginate(6)->withQueryString();
        }

        $totalCertificates = Certificate::count();
        $n5Certificates = Certificate::whereHas('attempt', function ($query) {
            $query->where('exam_id', 1);
        })->count();
        $n4Certificates = Certificate::whereHas('attempt', function ($query) {
            $query->where('exam_id', 2);
        })->count();
        $n3Certificates = Certificate::whereHas('attempt', function ($query) {
            $query->where('exam_id', 3);
        })->count();
        $n2Certificates = Certificate::whereHas('attempt', function ($query) {
            $query->where('exam_id', 4);
        })->count();
        $n1Certificates = Certificate::whereHas('attempt', function ($query) {
            $query->where('exam_id', 5);
        })->count();
        return view('admin.score.index', compact('certificates', 'totalCertificates', 'n5Certificates', 'n4Certificates', 'n3Certificates', 'n2Certificates', 'n1Certificates'));
    }

    public function showTopPassers()
    {
        $attempts = Attempt::with(['user', 'exam'])
            ->where('status', 'pass')
            ->whereHas('user', function ($query) {
                $query->where('status', 'active');
            })
            ->get();

        $order = ['N5' => 1, 'N4' => 2, 'N3' => 3, 'N2' => 4, 'N1' => 5,];

        $attempts = $attempts->sortBy(function ($a) use ($order) {
            $level = $a->exam->level ?? null;
            if (is_object($level)) {
                $level = $level->name ?? null;
            }
            return $order[$level] ?? 999;
        });

        $topPassersByLevel = [];

        foreach ($attempts->groupBy('exam_id') as $examId => $examAttempts) {
            $userBestScores = $examAttempts->groupBy('user_id')->map(function ($userAttempts) {
                return $userAttempts->sort(function ($a, $b) {
                    if ($a->mark != $b->mark) {
                        return $b->mark <=> $a->mark;
                    }
                    return $a->time_taken <=> $b->time_taken;
                })->first();
            })->values();

            $userBestScores = $userBestScores->sort(function ($a, $b) {
                if ($a->mark != $b->mark) {
                    return $b->mark <=> $a->mark;
                }
                return $a->time_taken <=> $b->time_taken;
            })->values();

            $topScores = $userBestScores->pluck('mark')->unique()->sortDesc()->take(3);

            $topPassersByLevel[$examId] = $userBestScores->filter(function ($item) use ($topScores) {
                return $topScores->contains($item->mark);
            });
        }
        return view('user.top_passers', compact('topPassersByLevel'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:30',
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                'regex:/^[a-zA-Z0-9.]+@gmail\.com$/i',
                Rule::unique('users')->ignore($user->id),
            ],
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('profiles'), $filename);

            $user->profile = 'profiles/' . $filename;
        }

        $user->save();

        return redirect()
            ->route('user.profile', $user->id)
            ->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function getCertificate($id)
    {
        $attempt = Attempt::findOrFail($id);

        $exists = Certificate::where('attempt_id', $attempt->id)->exists();

        if ($exists) {
            return back()->with('error', 'You already got this certificate!');
        }

        Certificate::create([
            'attempt_id' => $attempt->id,
        ]);

        $data = [
            'student_name' => $attempt->user->name,
            'topic'        => $attempt->exam->title,
            'score'        => $attempt->mark,
            'date'         => $attempt->created_at->timezone('Asia/Yangon')->format('d M Y , H:i:s'),
        ];
        $pdf = Pdf::loadView('user.certificate_pdf_template', $data)
            ->setPaper('a4', 'landscape');
        Mail::to($attempt->user->email)->send(new CertificateMail($attempt->user, $pdf->output(), $attempt->exam->title));


        return $pdf->download('Certificate_' . $attempt->user->name . '.pdf');
    }


    public function userStatus(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = 'inactive';
            $user->save();

            if (Auth::id() == $id) {
                Auth::logout();
                return redirect()->route('home')
                    ->with('success', 'User deactivated and logged out successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to deactivate user. Please try again.');
        }
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->status == 'active') {
            $user->status = 'inactive';
        } else {
            $user->status = 'active';
        }
        $user->save();
        return back()->with('success', 'Change status successfully!');
    }

    public function showChangePassword()
    {
        return view('user.profile.change_password');
    }

    /**
     * Change the authenticated user's password.
     */
    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password'          => ['required'],
            'new_password'              => ['required', 'string', 'confirmed', Password::min(8)],
            'new_password_confirmation' => ['required'],
        ], [
            'current_password.required'          => 'Current password is required.',
            'new_password.required'              => 'New password is required.',
            'new_password.min'                   => 'Password must be at least 8 characters.',
            'new_password.confirmed'             => 'Passwords do not match.',
            'new_password_confirmation.required' => 'Confirm password is required!',
        ]);
        $validator->after(function ($validator) use ($request) {
            if (empty($request->new_password)) {
                return;
            }

            $password = $request->new_password;
            $missing = [];

            if (!preg_match('/[A-Z]/', $password)) {
                $missing[] = 'uppercase letter';
            }
            if (!preg_match('/[0-9]/', $password)) {
                $missing[] = 'number';
            }
            if (!preg_match('/[\W_]/', $password)) {
                $missing[] = 'special symbol';
            }

            if (!empty($missing)) {
                if (count($missing) === 3) {
                    $msg = 'Password must contain at least one uppercase letter, number, and special symbol.';
                } elseif (count($missing) === 2) {
                    $msg = 'Password must contain at least one ' . $missing[0] . ' and ' . $missing[1] . '.';
                } else {
                    $msg = 'Password must contain at least one ' . $missing[0] . '.';
                }

                $validator->errors()->add('new_password', $msg);
            }
        });
        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('new_password')) {
                $passwordErrors = $errors->get('new_password');
                $firstError = array_shift($passwordErrors);

                $cleanedRemaining = array_map(function ($msg) {
                    $msg = preg_replace('/^the password must contain\s+/i', '', $msg);
                    $msg = preg_replace('/^the password\s+/i', '', $msg);
                    return $msg;
                }, $passwordErrors);

                if (!empty($cleanedRemaining)) {
                    $firstError = rtrim($firstError, '.');

                    foreach ($cleanedRemaining as &$msg) {
                        $msg = rtrim($msg, '.');
                    }

                    if (count($cleanedRemaining) > 1) {
                        $lastMsg = array_pop($cleanedRemaining);
                        $combinedSentence = $firstError . ', ' . implode(', ', $cleanedRemaining) . ', and ' . $lastMsg . '.';
                    } else {
                        $combinedSentence = $firstError . ' and ' . $cleanedRemaining[0] . '.';
                    }
                } else {
                    $combinedSentence = $firstError;
                }

                $messages = $errors->getMessages();
                $messages['new_password'] = [$combinedSentence];

                $errors = new \Illuminate\Support\MessageBag();
                $errors->merge($messages);
            }

            return redirect()->back()->withErrors($errors);
        }

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.'
            ]);
        }

        // 5. Encrypt and save updates cleanly
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user')->with('success', 'Password changed successfully');
    }

    public function sendRequest(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $existingRequest = ReactivationRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'Reactivation request already sent. Please wait for admin response.');
        }

        ReactivationRequest::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'status' => 'pending'
        ]);

        Mail::raw(
            'New Reactivation Request From: ' . $user->email,

            function ($message) {
                $message->to('khaingkhainglay984@gmail.com')->subject('Reactivation Request');
            }
        );

        return back()->with('success', 'Request sent successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $attempts = Attempt::with([
            'exam.level',
            'certificate'
        ])
            ->where('user_id', $id)
            ->orderBy('exam_id', 'asc')
            ->get();

        $attemptsCount = $attempts->count();
        $certificatesCount = $attempts->whereNotNull('certificate')->count();

        $levelCounts = $attempts
            ->groupBy(function ($attempt) {
                return optional($attempt->exam->level)->name ?? 'Unknown';
            })
            ->map(function ($group) {
                return $group->count();
            });

        $certificateLevelCounts = $attempts
            ->filter(function ($attempt) {
                return $attempt->certificate !== null;
            })
            ->groupBy(function ($attempt) {
                return optional($attempt->exam->level)->name ?? 'Unknown';
            })
            ->map(function ($group) {
                return $group->count();
            });

        return view('admin.user.details', compact(
            'user',
            'attempts',
            'attemptsCount',
            'certificatesCount',
            'levelCounts',
            'certificateLevelCounts'
        ));
    }
}
