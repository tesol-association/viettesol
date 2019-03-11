<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    protected $count = 0;
    public function getPapers($trackId)
    {
        $papers = DB::table('papers')->where('track_id', 1)->get();
        $this->writeLog("Show paper in Track with Track Id = " . $trackId);
        return view('layouts.admin.test', ['res' => $papers]);
    }

    public function sendPaper($trackId)
    {
        $paper = DB::table('papers')->insert([
            'abstract' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'author_id' => 1,
            'track_id' => $trackId
        ]);
        $this->writeLog("Insert Paper");
    }

    public function createReviewForm()
    {
        if ($this->count == 0) {
            $criteriaReview = DB::table('criteria_review')->insert([
                'name' => 'Format',
                'possible_values' => json_encode([1, 2, 3, 4, 5]),
            ],[
                'name' => 'Relative',
                'possible_values' => json_encode([1, 2, 3, 4, 5]),
            ]);
            $this->writeLog("Insert Criteria_review");
            $this->count++;
        }
        DB::table('review_form')->insert([
            'name' => 'test form review',
            'status' => 'active'
        ]);
        $this->writeLog("Insert to Review_Form Table");
        DB::table('review_form_setting')->insert([
            'review_form_id' => 1,
            'criteria_review_id' => 1,
        ]);
        $this->writeLog("Insert to Review_Form_Setting Table :" . 'review_form_id = 1' . ' - criteria_review_id = 1');
        DB::table('review_form_setting')->insert([
            'review_form_id' => 1,
            'criteria_review_id' => 2,
        ]);
        $this->writeLog("Insert to Review_Form_Setting Table :" . 'review_form_id = 1' . ' - criteria_review_id = 2');
    }

    public function showReviewForm()
    {
        $reviewForm = DB::table('review_form_setting')
                        ->join('review_form', 'review_form.id', '=', 'review_form_setting.review_form_id')
                        ->join('criteria_review', 'criteria_review.id', '=', 'review_form_setting.criteria_review_id')
                        ->get()
        ;
        $this->writeLog('Join review_form_setting, review_form and criteria_review');
        return view('layouts.admin.test', ['res' => $reviewForm]);
    }

    public function writeLog($message)
    {
        $myfile = file_put_contents('logs.txt', $message.PHP_EOL , FILE_APPEND | LOCK_EX);
        return $message;
    }
}
