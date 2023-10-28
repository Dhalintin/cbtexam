<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use App\Models\ExamAnswer;
use App\Models\ExamAttempt;
use App\Models\ExamRegistration;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginate;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{

    public function registerExam($id)
    {
        $userID = Auth()->user()->id;
        $examID = $id;

        $record = ExamRegistration::where('user_id', $userID)->where('exam_id', $examID)->get();

        if(count($record) == 0){
            $examReg = new ExamRegistration;
            $examReg->user_id = $userID;
            $examReg->exam_id = $examID;

            $examReg->save();

            return back()->with('success', 'You have successfully registered for this examination');
        }else{
            return back()->with('failed', 'You cannot register for an exam twice');
        }
    }

    public function destroyExamReg($id)
    {
        $userID = Auth()->user()->id;
        $record = ExamRegistration::where('user_id', $userID)->where('exam_id', $id)->get();
    }
    /**
     * Display a listing of the resource.
     */
    public function loadExam($id)
    {
       $exam = Exam::where('uniqueID', $id)->get();
        if(count($exam) > 0){
            $attemptCount = ExamAttempt::where(['exam_id'=>$exam[0]['id'], 'user_id'=>auth()->user()->id])->count();
            if( $attemptCount >= 1){
                return view('student.errorpage', ['success'=>false, 'msg'=>'You have taken this exam already']);
            }
            else if($exam[0]['date'] == date('Y-m-d')){
                $qna = Question::where('course_id', $exam[0]['course_id'])->with('answers')->inRandomOrder()->take(5)->get();
                if(count($qna) > 0){
                    return view('student.exam', ['success'=>true, 'exam'=>$exam, 'qna'=>$qna]);
                }else{
                    return view('student.errorpage', ['success'=>false, 'msg'=>'This exam is not available! It will be holding on '.$exam[0]['date'], 'exam'=>$exam]);
                }
                
            }else if($exam[0]['date'] > date('Y-m-d')){
                return view('student.errorpage', ['success'=>false, 'msg'=>'This exam will start on '.$exam[0]['date'], 'exam'=>$exam]);
            }else{
                return view('student.errorpage', ['success'=>false, 'msg'=>'This exam expired on '.$exam[0]['date'], 'exam'=>$exam]);
            }
        }else{

        }
        return view('student.exam');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function examSubmit(Request $request)
    {

        $attempt_id = ExamAttempt::insertGetId([
            'exam_id'=> $request->exam_id,
            'user_id'=> Auth::user()->id,
        ]);
        
        $id =  $request->exam_id;
        $qcount = count($request->q);
        $markspq = $request->score / $qcount;
        $mark = 0;

        if($qcount > 0){
            for($i = 0; $i < $qcount; $i++){
                $answer = Answer::where('id', request()->input('ans_'.($i+1)))->get();
                if($answer[0]->is_correct == 1){
                    $mark++;
                }
                // if(!empty($request->input('ans_'.($i+1)))){
                //     ExamAnswer::insert([
                //         'attempt_id' => $attempt_id,
                //         'question_id' => $request->q[$i],
                //         'answer_id' => request()->input('ans_'.($i+1))
                //     ]);

                // }
                
            }
        }


        $score = $markspq * $mark;
        $examreg = ExamRegistration::where(['exam_id'=>$request->exam_id, 'user_id'=>auth()->user()->id])->get();

        $request->validate([
            'score'=>'required'
        ]);

        $examreg[0]->score = $score;

        $examreg[0]->save();
        
        return view('student.errorpage', ['success'=>true, 'msg'=>'You have completed this exam']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
