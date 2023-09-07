<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        if(Auth::user() && Auth::user()->is_admin== 1){
            return redirect('/admin/dashboard');
        }else if(Auth::user() && Auth::user()->is_admin == 0){
            return redirect('dashboard');
        }
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

    public function loadLogin()
    {
        if(Auth::user() && Auth::user()->is_admin == 1){
            return redirect('/admin/dashboard');
        }else if(Auth::user() && Auth::user()->is_admin == 0){
            return redirect('dashboard');
        }
        return view('login');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'reg_no' => 'string|required',
            'password' => 'string|required'
        ]);

        $userCredential = $request->only('reg_no', 'password');

        if(Auth::attempt($userCredential)){

            if(Auth::user()->is_admin == 1){
                return redirect('/admin/dashboard');
            }else if(Auth::user()->is_admin == 2){
                return redirect('/cord/dashboard');
            }else{
                return redirect('dashboard');
            }
        }else{
            return back()->with('error', "Registration Number or Password incorrect!");
        }

        $user = new User;
        $user->name = $request->name;
        $user->reg_no = $request->reg_no;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Your registrtion has been successful.');
    }

    public function adminDashoard()
    {
        $courses = Course::all();
        return view('admin.dashboard', compact('courses'));
    }

    public function loadDashoard()
    {
       
        return view('student.dashboard');
    }

    public function cordDashboard()
    {
        return view('cord.dashboard');
    }


    public function logout(Request $request)
    {
        $request->session()->flash('','');
        Auth::logout();
        return redirect('/');
    }
}
