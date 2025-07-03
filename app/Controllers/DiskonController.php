<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskon;

    function __construct()
    {
        $this->diskon = new DiskonModel();
    }

    public function index()
    {
        $diskon = $this->diskon->findAll();
        $data['diskon'] = $diskon;

        return view('v_diskon', $data);
    }

    public function edit($id)
    {

        $dataForm = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->diskon->update($id, $dataForm);
        return redirect('diskon')->with('success', 'Data Berhasil Diubah');
    }

    public function create()
    {
        $tanggal = $this->request->getPost('tanggal');

        // cek apakah tanggal sudah ada di database
        $existing = $this->diskon->where('tanggal', $tanggal)->first();

        if ($existing) {
            return redirect('diskon')->back()->withInput()->with('error', 'Diskon tanggal ini sudah ada');
        }

        // jika aman
        $dataForm = [
            'tanggal' => $tanggal,
            'nominal' => $this->request->getPost('nominal'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->diskon->insert($dataForm);
        return redirect('diskon')->with('success', 'Data Berhasil Ditambah');
    }

    public function delete($id)
    {
        $dataDiskon = $this->diskon->find($id);
        $this->diskon->delete($id);
        return redirect('diskon')->with('success', 'Data Berhasil Dihapus');
    }

}
