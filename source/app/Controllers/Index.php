<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Index extends BaseController
{
    public function index()
    {
        // $scheduleLib = new \App\Libraries\ScheduleLibrary();
        $surveyModel = new \App\Models\SurveyModel();

        $data = [
            'casts'        => [],//$scheduleLib->getSchedules(), // APIから取得
            'activeSurvey' => $surveyModel->where('is_published', 1)->first(), // 公開中アンケート
        ];

        return view('front/top', $data);
    }

    public function top()
    {
        // $scheduleLib = new \App\Libraries\ScheduleLibrary();
        $surveyModel = new \App\Models\SurveyModel();

        $data = [
            'casts'        => [],//$scheduleLib->getSchedules(), // APIから取得
            'activeSurvey' => $surveyModel->where('is_published', 1)->first(), // 公開中アンケート
        ];

        return view('front/top', $data);
    }
    
}
