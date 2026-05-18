<?php

namespace App\Http\Controllers;

use App\Models\ReactivationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function accept($id)
    {
        $request = ReactivationRequest::findOrFail($id);

        $user = User::find($request->user_id);

        $user->status = 'active';
        $user->save();

        $request->status = 'accepted';
        $request->save();

        Mail::raw(
            'Your account has been reactivated successfully.',
            function ($message) use ($user) {

                $message->to($user->email)
                    ->subject('Account Reactivated');
            }
        );

        return back()->with(
            'success',
            'User account activated.'
        );
    }

    public function reject($id)
    {
        $request = ReactivationRequest::findOrFail($id);

        $request->status = 'rejected';
        $request->save();

        Mail::raw(
            'Your reactivation request was rejected.',
            function ($message) use ($request) {

                $message->to($request->email)
                    ->subject('Reactivation Rejected');
            }
        );

        return back()->with(
            'success',
            'Request rejected.'
        );
    }

    public function mailbox()
    {
        $requests = ReactivationRequest::latest()->get();

        return view(
            'admin.mailbox',
            compact('requests')
        );
    }
}
