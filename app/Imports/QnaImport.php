<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Answer;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;


class QnaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        \Log::info($row);

        if($row[0] != "Question"){

            $questionId = Question::insertGetId([
                'question' => $row[0],
                'course_id' => $row[1],
                'type' => $row[2]
            ]);

            for($i = 3; $i < count($row) - 1; $i++){
                 
                if($row[$i] != null){
                    
                    $is_correct = false;
                    if($row[7] == $row[$i]){
                        $is_correct = true;
                    }

                    Answer::insert([
                        'question_id' => $questionId,
                        'answer' => $row[$i],
                        'is_correct' => $is_correct
                    ]);
                }
            }

        }  
    }
}
