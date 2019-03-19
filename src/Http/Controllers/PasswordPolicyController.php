<?php

namespace Simplesales\PasswordPolicy\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Simplesales\PasswordPolicy\PasswordPolicy;

class PasswordPolicyController
{
    public function show()
    {
        return view('password-policy::show');
    }

    public function store(Request $request)
    {
        $plain_password = $request->password;
        $confirm        = $request->password_confirm;

        if ($plain_password != $confirm)
        {
            $error_message = 'Password and Confirmation Did Not Match.  Please Try Again';
            return view('password-policy::show',compact('error_message'));
        }

        $policy = new PasswordPolicy($plain_password);
        if (!$policy->satisfies_password_policy())
        {
            $error_message = 'New Password Must Conform To Password Policy Guidelines.  Please Try Again';
            return view('password-policy::show',compact('error_message'));
        }

        $hashed_password = Hash::make($request->password);
        $user            = auth()->user();
        $user->password  = $hashed_password;
        $user->save();

        flash('Password Reset Successfully');
        return redirect()->route(config('password-policy.successful_redirect_route'));
    }
}