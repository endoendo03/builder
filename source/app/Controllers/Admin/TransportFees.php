<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransportFeeModel;

class TransportFees extends BaseController
{
    public function index()
    {
        $model = new TransportFeeModel();
        // 区、行、町名の順に綺麗に並べて取得
        $data['fees'] = $model->orderBy('ward', 'ASC')
                              ->orderBy('syllabary', 'ASC')
                              ->orderBy('town_name', 'ASC')
                              ->findAll();
                              
        return view('admin/transport_fees/index', $data);
    }

    public function store()
    {
        $model = new TransportFeeModel();
        
        $data = [
            'ward'      => $this->request->getPost('ward'),
            'syllabary' => $this->request->getPost('syllabary'),
            'town_name' => $this->request->getPost('town_name'),
            'fee'       => $this->request->getPost('fee'),
        ];

        // idがあればUPDATE、なければINSERT（自動で判別！）
        if ($this->request->getPost('id')) {
            $data['id'] = $this->request->getPost('id');
        }

        $model->save($data);
        return redirect()->to('admin/transport_fees')->with('message', '交通費データを保存しました！');
    }

    public function delete($id)
    {
        $model = new TransportFeeModel();
        $model->delete($id);
        return redirect()->to('admin/transport_fees')->with('message', '交通費データを削除しました。');
    }
}