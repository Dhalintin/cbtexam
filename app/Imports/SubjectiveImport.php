<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Answer;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SubjectiveImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        \Log::info($row);

        if($row[0] != "Question" && $row[0] != null){
            $questionId = Question::insertGetId([
                'question' => $row[0],
                'course_id' => $row[1],
                'type' => $row[2]
            ]);

            $is_correct = 1;

            Answer::insert([
                'question_id' => $questionId,
                'answer' => $row[3],
                'is_correct' => $is_correct
            ]);
        }  
    }
}
