<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list()
    {
        $Users = User::all();
        return view('admin.user.list', compact('Users'));
    }

    public function add()
    {
        return view('admin.user.add');
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name'      => ['required'],
            'username'  => ['required', 'unique:users'],
            'email'     => ['required', 'unique:users'],
            'password'  => ['required'],
        ]);

        $User = new User();
        $User->name     = $request->name;
        $User->username = $request->username;
        $User->email    = $request->email;
        $User->password = Hash::make($request->password);
        $User->active   = ($request->active) ? 1 : 0;
        $User->save();

        return redirect()->route('admin.user.list');
    }

    public function edit(User $User)
    {
        return view('admin.user.edit', compact('User'));
    }

    public function update(Request $request, User $User)
    {
        $request->validate([
            'name'      => ['required'],
            'username'  => ['required'],
            'email'     => ['required'],
        ]);

        $Check = User::where('id', '<>', $User->id)
            ->where('email', $request->email)->first();

        if ($Check) {
            return redirect()->back()->withErrors('User Already Exist');
        }

        $Check = User::where('id', '<>', $User->id)
            ->where('username', $request->username)->first();

        if ($Check) {
            return redirect()->back()->withErrors('User Already Exist');
        }

        $User->name     = $request->name;
        $User->username = $request->username;
        $User->email    = $request->email;
        $User->active   = ($request->active) ? 1 : 0;
        if ($request->password) {
            $User->password = Hash::make($request->password);
        }
        $User->save();

        return redirect()->route('admin.user.list');
    }

    public function active(User $User)
    {
        $User->active = !$User->active;
        $User->save();

        return redirect()->route('admin.user.list');
    }
}
