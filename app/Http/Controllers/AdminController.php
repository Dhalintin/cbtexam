<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;

use App\Imports\QnaImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginate;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;



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
                'course' => 'required',
                'course_code' => 'required'
            ]);

            //Create data in database
            $course->update($request->all());

            //Redirect
            return redirect('/admin/dashboard')->with('success', 'Course updated successfully');
        
        }catch(\Exception $e){
            // return response()->json(['sucess'=>false,'msg'=>$e->getMessage()]);
            
            return redirect('/admin/dashboard')->with('failed', $e->getMessage());
           
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
        // $questions = Course::find($courseId)->exams->find($examId)->questions;
        
        return view('/admin/exam', compact('exams'), compact('courses'));
    }

    public function addExam(Request $request)
    {
        try{

            $attempt = 0;
            $uniqueID = uniqid('exid');
            
            $request->validate([
                'exam_name' => 'required',
                'course_id' => 'required',
                'date' => 'required',
                'time' => 'required',
                'score'=>'required'
            ]);

            Exam::insert([
                'exam_name' => $request->exam_name,
                'course_id' => $request->course_id,
                'date' => $request->date,
                'time' => $request->time,
                'attempt' => $attempt,
                'uniqueID' => $uniqueID,
                'score' => $request->score
            ]);
            

            return redirect('/admin/exam')->with('success', 'Exam added successfully');

        }catch(\Exception $e){
            return redirect('/admin/exam')->with('failed', 'An error occured!');
           
        };
    }

    public function deleteExam(Exam $exam)
    {
        $exam->delete();
        return redirect('/admin/exam')->with('success', 'Course removed successfully');
    }


    public function qnaDashboard()
    {
        $courses = Course::all();

        $questions = Question::all();//->paginate(5);
        $answers = Answer::all();

        return view('admin/qna', compact('questions'), compact('courses'), compact('answers'));
    }

    public function courseQna(Course $course)
    {
        $courseId = $course->id;
        $course = Course::find($courseId);
        $questions = $course->questions;
        $courses = Course::all();
        return view('admin/qna', compact('questions'), compact('courses'));
    }

    public function addQuestion(Request $request)
    {
        try{

            $questionId = Question::insertGetId([
                'question' => $request->question,
                'course_id' => $request->course_id,
                'type' => $request->type
            ]);

            foreach($request->answers as $answer){

                $is_correct = 0;
                if($request->is_correct == $answer){
                    $is_correct = 1;
                }

                Answer::insert([
                    'question_id' => $questionId,
                    'answer' => $answer,
                    'is_correct' => $is_correct

                ]);
            }

            
            Question::create($request->all());

            return redirect('/admin/qna')->with('success', 'Question added successfully');

        }catch(\Exception $e){
            return redirect('/admin/qna')->with('failed', $e->getMessage());
           
        };

    }

    public function editQuestion(Request $request, Question $question)
    {
        try {
            $request->validate([
                'question' => 'required',
                'course_id' => 'required',
                'type' => 'required',
            ]);

            $question->update([
                'question' => $request->question,
                'type' => $request->type
            ]);
            
            for($i = 0; $i < count($request->answers); $i++){
                dd($request->has('is_correct'));
                Answer::where('id',$question->answers[$i]['id'])
                ->update([
                    'answer' => $request->answers[$i],
                    'is_correct' => $request->input('is_correct') === $answer ? 1 : 0,
                ]);
            }

            // $question->save();
            dd($request->answers[0], $question->answers[0]['is_correct'], $request->input('is_correct'));
            // $question->answers[0]['answer']
            return redirect()->back()->with('success', 'Question updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        };
    }

    public function uploadQuestion(Request $request)
    {       
        try{

            $request->validate([
                'file' => [
                    'required',
                    'mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'mimes:xls,xlsx,xlsm,xlsb,xltm,xltx,xlam,ods',
                ]
            ]);

            Excel::import(new QnaImport, $request->file('file'));

            return redirect()->back()->with('success', 'Question uploaded successfully');

        }catch(\Exception $e)
        {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function deleteQuestion(Question $question)
    {
        $question->delete();
        return redirect()->back()->with('success', 'Question removed successfully');
    }

    //Students Dashboard
    public function students()
    {
        $students = User::where('is_admin', 0)->get();
        return view('admin.student', compact('students'));
    }

}
