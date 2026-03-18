<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HotelModel;

class Hotels extends BaseController
{
    protected $hotelModel;

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
    }

    // ホテル一覧
    public function index()
    {
        $data = [
            'title'  => 'ホテル管理'
        ];
        $data['hotels'] = $this->hotelModel
                           ->orderBy('is_pickup', 'DESC')
                           ->orderBy('sort_order', 'ASC')
                           ->orderBy('id', 'DESC')
                           ->findAll();
        return view('admin/hotels/index', $data);
    }

    // 保存（新規・更新 兼用）
    public function store()
    {
        $id = $this->request->getPost('id');
        
        $saveData = [
            'name'          => $this->request->getPost('name'),
            'address'       => $this->request->getPost('address'),
            'tel'           => $this->request->getPost('tel'),
            'transport_fee' => $this->request->getPost('transport_fee'),
            'is_available'  => $this->request->getPost('is_available') ?? 0,
            'is_pickup'     => $this->request->getPost('is_pickup') ?? 0,
            'sort_order'    => $this->request->getPost('sort_order') ?? 100,
            'note'          => $this->request->getPost('note'),
        ];

        if ($id) {
            $saveData['id'] = $id;
        }

        if ($this->hotelModel->save($saveData)) {
            return redirect()->to('admin/hotels')->with('message', 'ホテル情報を保存しました');
        }

        return redirect()->back()->with('error', '保存に失敗しました')->withInput();
    }

    // 削除
    public function delete($id)
    {
        $this->hotelModel->delete($id);
        return redirect()->to('admin/hotels')->with('message', 'ホテルを削除しました');
    }
}