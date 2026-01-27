<?php namespace App\Controllers;

use App\Models\SurveyModel;
use App\Models\SurveyQuestionModel;
use App\Models\SurveyResponseModel;

class Survey extends BaseController
{
    // アンケート回答画面の表示
    public function show($id = null)
    {
        $surveyModel = new SurveyModel();
        $questionModel = new SurveyQuestionModel();

        $survey = $surveyModel->find($id);
        if (!$survey || $survey['status'] !== 'open') {
            return "このアンケートは公開されていないか、存在しません。";
        }

        $data = [
            'survey'    => $survey,
            'questions' => $questionModel->where('survey_id', $id)->findAll(),
        ];

        return view('survey_view', $data);
    }

    // 回答の保存
    public function submit($id = null)
    {
        $responseModel = new SurveyResponseModel();
        
        // 全てのPOSTデータを取得
        $answers = $this->request->getPost('answers');

        $data = [
            'survey_id'    => $id,
            'user_id'      => session()->get('user_id'), // ログインしていれば保存
            'answers_json' => json_encode($answers, JSON_UNESCAPED_UNICODE), // JSON形式で保存
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $responseModel->insert($data);

        return "ご回答ありがとうございました！";
    }
}