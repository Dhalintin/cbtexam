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

    public function destroy($id)
    {   
        try
        {
            $userID = Auth()->user()->id;
            $record = ExamRegistration::where('exam_id', $id)->where('user_id', $userID)->get();
            $rec = ExamRegistration::findOrFail($record[0]['id']);
            $rec->delete();
            return back()->with('success', 'Exam deleted successfully');
        }catch (Exception $e)
        {
            return view('dashboard')->with('failed', $e->getMessage());
        }
        
    }
    /**
     * Display a listing of the resource.
     */
    public function loadExam($id)
    {
       $exam = Exam::where('uniqueID', $id)->get();
       $examType = Auth()->user()->exam_mode;
        if(count($exam) > 0){
            $attemptCount = ExamAttempt::where(['exam_id'=>$exam[0]['id'], 'user_id'=>auth()->user()->id])->count();
            if( $attemptCount >= 1){
                return view('student.errorpage', ['success'=>false, 'msg'=>'You have taken this exam already']);
            }
            else if($exam[0]['date'] == date('Y-m-d')){
                if($examType === 'objective'){
                    $qna = Question::where('course_id', $exam[0]['course_id'])->where('type', 'objective')->with('answers')->inRandomOrder()->take(5)->get();
                    if(count($qna) > 0){
                        return view('student.exam', ['success'=>true, 'exam'=>$exam, 'qna'=>$qna, 'type'=>'objective']);
                    }else{
                        return view('student.errorpage', ['success'=>false, 'msg'=>'This exam is not available! It will be holding on '.$exam[0]['date'], 'exam'=>$exam]);
                    }
                }else{
                    $qna = Question::where('course_id', $exam[0]['course_id'])->where('type', 'subjective')->with('answers')->inRandomOrder()->take(5)->get();
                    if(count($qna) > 0){
                        return view('student.exam', ['success'=>true, 'exam'=>$exam, 'qna'=>$qna, 'type'=>'subjective']);
                    }else{
                        return view('student.errorpage', ['success'=>false, 'msg'=>'This exam is not available! It will be holding on '.$exam[0]['date'], 'exam'=>$exam]);
                    }
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
    public function examSubmit(Request $request, $mode)
    {
        $attempt_id = ExamAttempt::insertGetId([
            'exam_id'=> $request->exam_id,
            'user_id'=> Auth::user()->id,
        ]);
        
        $id =  $request->exam_id;
        $qcount = count($request->q);
        $markspq = 3;
        $mark = 0;
        if($mode == 'objective'){
            if($qcount > 0){
                for($i = 0; $i < $qcount; $i++){
                    $answer = Answer::where('id', request()->input('ans_'.($i+1)))->get();
                    if($answer[0]->is_correct == 1){
                        $mark++;
                    }
                    if(!empty($request->input('ans_'.($i+1)))){
                        ExamAnswer::insert([
                            'attempt_id' => $attempt_id,
                            'question_id' => $request->q[$i],
                            'answer_id' => request()->input('ans_'.($i+1))
                        ]);
    
                    }
                    
                }
            }
        }else{
            if($qcount > 0){
                for($i = 0; $i < $qcount; $i++){
                    $question = Question::where('id', $request->q[$i])->with('answers')->get();
                    $answer = 'answer_'.$i+1;
                    $answerUser = strtolower($request->$answer);
                    $answerCorrect = strtolower($question[0]['answers'][0]['answer']);

                    $answerUser = preg_replace('/\s+/', '', $answerUser);
                    $answerCorrect = preg_replace('/\s+/', '', $answerCorrect);
                    if($answerUser === $answerCorrect){
                        $mark++;
                    }else{
                        $string1Length = strlen($answerUser);
                        $string2Length = strlen($answerCorrect);

                        $length = ($string1Length < $string2Length) ? $string1Length : $string2Length;

                        $matchingCharacters = 0;
                        for ($i = 0; $i < $length; $i++) {
                            if ($answerUser[$i] === $answerCorrect[$i]) {
                                $matchingCharacters++;
                            }
                        }

                        $similarity = $matchingCharacters / max($string1Length, $string2Length);

                        if($similarity >= 0.60){
                            $mark++;
                        }
                    }
                }

            }

        }

        $score = $markspq * $mark;
        $examreg = ExamRegistration::where(['exam_id'=>$request->exam_id, 'user_id'=>auth()->user()->id])->get();
        $mark = ExamAttempt::where('id', $attempt_id)->get();
        $mark[0]->marks = $score;
        $mark[0]->save();

        $request->validate([
            'score'=>'required'
        ]);

        $examreg[0]->score = $score;

        $examreg[0]->save();
        
        return view('student.errorpage', ['success'=>true, 'msg'=>'You have completed this exam']);
    }

}
