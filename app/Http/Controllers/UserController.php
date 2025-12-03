<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\HelpEmail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function sendHelpEmail(Request $request)
    {
        $user = $request->user();

        // Check if email already sent today
        if ($user->last_help_email && $user->last_help_email->isToday()) {
            return response()->json(['message' => 'Email already sent today'], 200);
        }

        // Send help email
        Mail::to($user->email)->send(new HelpEmail($user));

        // Update last_help_email timestamp
        $user->last_help_email = now();
        $user->save();

        return response()->json(['message' => 'Help email sent'], 200);
    }
}
