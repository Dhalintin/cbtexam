<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    //

    public function addCourse(Request $request)
    {
        try{

            $request->validate([
                'course' => 'required', 'unique:courses,course',
                'course_code' => 'required', 'unique:courses,course_code'
            ]);

            
            Course::create($request->all());

            return redirect('/admin/dashboard')->with('success', 'Course added successfully');

        }catch(\Exception $e){
            return redirect('/admin/dashboard')->with('failed', 'An error occured!');
           
        };
    }

    public function edit(Course $course)
    {
        return view('admin/edit', compact('course'));
    }

    public function editCourse(Request $request, Course $course)
    {
        try
        {
            //Validate
            $request->validate([
                'course' => 'required', 'unique',
                'course_code' => 'required'
            ]);

            //Create data in database
            $course->update($request->all());

            //Redirect
            return redirect('/admin/dashboard')->with('success', 'Course updated successfully');
        
        }catch(\Exception $e){
            // return response()->json(['sucess'=>false,'msg'=>$e->getMessage()]);
            
            return redirect('/admin/dashboard')->with('failed', 'Update failed!!');
           
        };
    }

    public function deleteCourse(Course $course)
    {
        $course->delete();
        return redirect('/')->with('success', 'Course deleted successfully');;
    }


    //Admin Exam
    public function examDashboard()
    {
        $courses = Course::all();
        $exams = Exam::with('courses')->get();
        
        return view('/admin/exam', compact('exams'), compact('courses'));
    }

    public function addExam(Request $request)
    {
        try{

            $request->validate([
                'exam_name' => 'required',
                'course_id' => 'required',
                'date' => 'required',
                'time' => 'required',
            ]);

            
            Exam::create($request->all());

            return redirect('/admin/exam')->with('success', 'Exam added successfully');

        }catch(\Exception $e){
            return redirect('/admin/exam')->with('failed', 'An error occured!');
           
        };
    }

    public function deleteExam(Exam $exam)
    {
        $exam->delete();
        return redirect('/admin/exam')->with('success', 'Course removed successfully');;
    }


    public function qnaDashboard()
    {
        return view('/admin/qna');
    }
}
