<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function Login()
    {
        return view('admin.login');
    }

    public function LoginSubmit(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'email:filter', 'exists:users'],
            'password'  => ['required']
        ]);

        $User = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $User->password)) {
            return redirect()->back()->withErrors('Password Incorrect');
        }

        Auth::login($User);

        return redirect()->route('admin.home');
    }

    public function RegisterSubmit(Request $request)
    {
        $request->validate([
            'name'      => ['required'],
            'username'  => ['required', 'unique:users'],
            'email'     => ['required', 'email:filter', 'unique:users'],
            'password'  => ['required']
        ]);

        $User = new User();
        $User->name = $request->name;
        $User->username = $request->username;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->save();

        Auth::login($User);

        return redirect()->route('admin.home');
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
