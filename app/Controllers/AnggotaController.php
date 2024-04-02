<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AnggotaController extends ResourceController
{
    protected $modelName = 'App\Models\DaftarAnggotaModel';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->findAll();

        if (!empty($data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data retrieved successfully', 'data' => $data]);
        } else {
            return $this->failNotFound('No data found.');
        }
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'nomor_hp' => 'required',
            'tanggal_setoran' => 'required',
            'jumlah_setor' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $data = [
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'alamat' => $this->request->getVar('alamat'),
            'nomor_hp' => $this->request->getVar('nomor_hp'),
            'tanggal_setoran' => $this->request->getVar('tanggal_setoran'),
            'jumlah_setor' => $this->request->getVar('jumlah_setor'),
        ];

        $this->model->insert($data);

        return $this->respondCreated(['status' => 200, 'message' => 'Anggota added successfully.']);
    }

    public function edit($id = null)
{
    if ($id === null) {
        return $this->fail('ID anggota harus diberikan untuk mengedit.');
    }

    $anggota = $this->model->find($id);

    if ($anggota) {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'nomor_hp' => 'required',
            'tanggal_setoran' => 'required',
            'jumlah_setor' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $data = [
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'alamat' => $this->request->getVar('alamat'),
            'nomor_hp' => $this->request->getVar('nomor_hp'),
            'tanggal_setoran' => $this->request->getVar('tanggal_setoran'),
            'jumlah_setor' => $this->request->getVar('jumlah_setor'),
        ];

        $this->model->update($id, $data);

        return $this->respondUpdated(['status' => 200, 'message' => 'Anggota updated successfully.']);
    } else {
        return $this->failNotFound('Anggota not found.');
    }
}


    public function delete($id = null)
    {
        if ($id === null) {
            return $this->fail('ID anggota harus diberikan untuk menghapus.');
        }

        $anggota = $this->model->find($id);

        if ($anggota) {
            $this->model->delete($id);
            return $this->respondDeleted(['status' => 200, 'message' => 'Anggota deleted successfully.']);
        } else {
            return $this->failNotFound('Anggota not found.');
        }
    }
}
