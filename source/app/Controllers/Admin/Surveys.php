<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SurveyModel;
use App\Models\SurveyQuestionModel;

class Surveys extends BaseController
{
    public function index()
    {
        $model = new \App\Models\SurveyModel();
        $data = [
            'page_title' => 'アンケート管理',
            'surveys'    => $model->orderBy('id', 'desc')->findAll(),
        ];
        return view('admin/surveys/index', $data);
    }

    public function create()
    {
        $model = new \App\Models\SurveyModel();
        $model->insert([
            'title'       => $this->request->getPost('title'),
            'status'      => 'open',
            'created_at'  => date('Y-m-d H:i:s'),
        ]);
        return redirect()->to(url_to('Admin\Surveys::index'));
    }

    // 編集画面（ここで設問も管理する）
    public function edit($id = null)
    {
        $surveyModel = new SurveyModel();
        $questionModel = new SurveyQuestionModel();

        $data = [
            'page_title' => 'アンケート編集・設問設定',
            'survey'     => $surveyModel->find($id),
            'questions'  => $questionModel->where('survey_id', $id)->findAll(),
        ];

        return view('admin/surveys/edit', $data);
    }

    // 設問の追加処理
    public function addQuestion($survey_id)
    {
        $model = new SurveyQuestionModel();
        $model->insert([
            'survey_id' => $survey_id,
            'question'  => $this->request->getPost('question'),
            'type'      => $this->request->getPost('type'),
        ]);

        return redirect()->back()->with('success', '設問を追加しました');
    }

    // 設問の削除処理
    public function deleteQuestion($id)
    {
        $model = new SurveyQuestionModel();
        $model->delete($id);
        return redirect()->back()->with('success', '設問を削除しました');
    }
    public function responses($id = null)
    {
        $surveyModel = new \App\Models\SurveyModel();
        $questionModel = new \App\Models\SurveyQuestionModel();
        $responseModel = new \App\Models\SurveyResponseModel();

        $survey = $surveyModel->find($id);
        $questions = $questionModel->where('survey_id', $id)->findAll();
        $responses = $responseModel->where('survey_id', $id)->orderBy('created_at', 'desc')->findAll();

        // 設問をIDをキーにした連想配列に組み替える（Viewで使いやすくするため）
        $questionsById = [];
        foreach ($questions as $q) {
            $questionsById[$q['id']] = $q['question'];
        }

        $data = [
            'page_title'    => '回答結果一覧: ' . $survey['title'],
            'survey'        => $survey,
            'questionsById' => $questionsById,
            'responses'     => $responses,
        ];

        return view('admin/surveys/responses', $data);
    }
}
