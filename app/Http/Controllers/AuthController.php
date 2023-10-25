<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exam;
use App\Models\ExamRegistration;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    //Student Registraion
    public function loadRegister()
    {
        if(Auth::user() && Auth::user()->is_admin== 1){
            return redirect('/admin/dashboard');
        }else if(Auth::user() && Auth::user()->is_admin == 0){
            return redirect('dashboard');
        }else if(Auth::user() && Auth::user()->is_admin == 2){
            return redirect('cord/dashboard');
        }
        return view('register');
    }

    public function studentRegister(Request $request)
    {
        $request->validate([
            'fname' => 'string|required|min:2',
            'lname' => 'string|required|min:2',
            'email' => 'string|required|unique:users',
            'reg_no' => 'string|unique:users',
            'password' => 'string|required|confirmed|min:6',
            'role' => 'string|required'
        ]);

        $user = new User;
        $user->name = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->is_admin = $request->role;
        if($request->lname){
            $user->mname = $request->mname;
        }

        if($request->reg_no){
            $user->reg_no = $request->reg_no;
        }
        
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('dashboard')->with('success', 'Your registration has been successful.');
    }

    //Admin Registration
    public function loadAdminReg()
    {
        if(Auth::user() && Auth::user()->is_admin== 1){
            return redirect('/admin/dashboard');
        }else if(Auth::user() && Auth::user()->is_admin == 0){
            return redirect('dashboard');
        }
        return view('admin.adminregister');
    }

    public function adminRegister(Request $request)
    {
        $request->validate([
            'fname' => 'string|required|min:2',
            'lname' => 'string|required|min:2',
            'mname' => 'string',
            'email' => 'string|required|unique:users',
            'password' => 'string|required|confirmed|min:6'
        ]);

        $user = new User;
        $user->name = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->reg_no = $request->email;
        $user->is_admin = '1';
        if($request->mname){
            $user->mname = $request->mname;
        }
        
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('dashboard')->with('success', 'Your registration has been successful.');
    }

     //Coordinators Registraion
     public function loadCordReg()
     {
         if(Auth::user() && Auth::user()->is_admin== 1){
             return redirect('/admin/dashboard');
         }else if(Auth::user() && Auth::user()->is_admin == 0){
             return redirect('dashboard');
         }else if(Auth::user() && Auth::user()->is_admin == 2){
             return redirect('cord/dashboard');
         }
         return view('cord.cordregister');
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
                return redirect('/admin/dashboard')->with('user', auth()->user());
            }else if(Auth::user()->is_admin == 2){
                return redirect('/cord/dashboard')->with('user', auth()->user());
            }else{
                return redirect('dashboard')->with('user', auth()->user());
            }
        }else{
            return back()->with('error', "Registration Number or Password incorrect!");
        }

        $user = new User;
        $user->name = $request->name;
        $user->reg_no = $request->reg_no;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Your registration has been successful.');
    }

    public function adminDashoard()
    {
        $courses = Course::all();
        $user = session('user');

        return view('admin.dashboard', compact('courses'), compact('user'));
    }

    public function loadDashoard()
    {
        $exams = Exam::with('courses')->orderBy('date')->get();
        $regExam = ExamRegistration::with('exams.courses')->get();
        return view('student.dashboard', compact('exams'), compact('regExam'));
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
