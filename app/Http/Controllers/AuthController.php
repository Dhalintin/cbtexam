<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        return view('register');
    }

    public function studentRegister(Request $request)
    {
        $request->validate([
            'name' => 'string|required|min:2',
            'reg_no' => 'string|required|unique:users',
            'password' => 'string|required|confirmed|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->reg_no = $request->reg_no;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Your registrtion has been successful.');
    }
}
