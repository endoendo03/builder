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
            'surveys'    => $model->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('admin/surveys/index', $data);
    }

    public function create()
    {
        $model = new \App\Models\SurveyModel();
        $title = $this->request->getPost('title');

        if (empty($title)) {
            return redirect()->back()->with('error', 'タイトルを入力してください。');
        }
        $minOrder = $model->selectMin('sort_order')->first();
        $newOrder = (isset($minOrder['sort_order'])) ? $minOrder['sort_order'] - 1 : 0;

        $data = [
            'title'      => $title,
            // 'status'     => 'stop',
            'sort_order' => $newOrder,
        ];

        if ($model->insert($data)) {
            return redirect()->to('/admin/surveys')->with('success', '新規アンケートを作成しました。');
        } else {
            return redirect()->back()->with('error', '作成に失敗しました。');
        }
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
    public function publish($id)
    {
        $model = new \App\Models\SurveyModel();

        $db = \Config\Database::connect();
        $db->transStart();

        // 全てのアンケートの公開フラグを0（非公開）にする
        $model->where('is_published', 1)->set(['is_published' => 0])->update();

        // 指定されたIDのアンケートだけを1（公開）にする
        $model->update($id, ['is_published' => 1]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', '更新に失敗しました。');
        }

        return redirect()->back()->with('success', 'フロント表示を切り替えました！');
    }
    public function delete($id)
    {
        $model = new \App\Models\SurveyModel();
        
        // 
        if (!$model->find($id)) {
            return redirect()->back()->with('error', '対象が見つかりません。');
        }

        // 
        $model->delete($id);

        return redirect()->to('/admin/surveys')->with('success', 'アンケートを削除（非表示）にしました。');
    }

    public function update($id)
    {
        $model = new \App\Models\SurveyModel();

        // バリデーション（タイトル必須）
        if (!$this->validate(['title' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('error', 'タイトルを正しく入力してください。');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            // 必要ならここでtypeなども更新対象に含める
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/admin/surveys')->with('success', 'アンケート名を更新しました！');
        } else {
            return redirect()->back()->with('error', '更新に失敗しました。');
        }
    }
    public function reorder()
    {
        $json = $this->request->getJSON();
        $ids = $json->ids;

        if (empty($ids)) {
            return $this->response->setJSON(['status' => 'error']);
        }

        $model = new \App\Models\SurveyModel();
        
        // トランザクションで一気に更新
        $db = \Config\Database::connect();
        $db->transStart();

        foreach ($ids as $index => $id) {
            // 
            $model->update($id, ['sort_order' => $index]);
        }

        $db->transComplete();

        return $this->response->setJSON(['status' => 'success']);
    }
}
