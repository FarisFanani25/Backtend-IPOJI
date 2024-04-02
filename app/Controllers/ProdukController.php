<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ProdukController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $testimoniModel = new \App\Models\ProdukModel();
        $data = $testimoniModel->findAll();

        if (!empty($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No data found',
                'data' => []
            ];
        }

        return $this->respond($response);
    }

    public function create()
    {
        $model = new \App\Models\ProdukModel();
    
        $validation = \Config\Services::validation();
        $rules = [
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'deskripsi_produk' => 'required',
            'stok_tersedia' => 'required',
            'berat_produk' => 'required',
            'gambar_produk' => 'uploaded[gambar_produk]|max_size[gambar_produk,1024]|is_image[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png]',
        ];
    
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($validation->getErrors());
        }
    
        // Dapatkan file gambar yang diunggah
        $gambar = $this->request->getFile('gambar_produk');
        $namaGambar = $gambar->getRandomName();
        $gambar->move('gambar', $namaGambar);
    
        // Buat data produk
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga_produk' => $this->request->getVar('harga_produk'),
            'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
            'stok_tersedia' => $this->request->getVar('stok_tersedia'),
            'berat_produk' => $this->request->getVar('berat_produk'),
            'gambar_produk' => $namaGambar,
        ];
    
        // Simpan data produk
        $model->insert($data);
    
        return $this->respondCreated(['status' => 200, 'message' => 'Product created successfully.']);
    }
    

    public function edit($id = null)
    {
        $model = new \App\Models\ProdukModel();
    
        // Pastikan ID produk diberikan
        if ($id === null) {
            return $this->fail('ID produk harus diberikan untuk mengedit.');
        }
    
        // Mencari data produk berdasarkan ID
        $produk = $model->find($id);
    
        // Jika produk ditemukan
        if ($produk) {
            // Validasi input
            $validation = \Config\Services::validation();
            $rules = [
                'nama_produk' => 'required',
                'harga_produk' => 'required',
                'deskripsi_produk' => 'required',
                'stok_tersedia' => 'required',
                'berat_produk' => 'required',
            ];
    
            if (!$this->validate($rules)) {
                return $this->failValidationErrors($validation->getErrors());
            }
    
            // Mendapatkan data input
            $data = [
                'nama_produk' => $this->request->getVar('nama_produk'),
                'harga_produk' => $this->request->getVar('harga_produk'),
                'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
                'stok_tersedia' => $this->request->getVar('stok_tersedia'),
                'berat_produk' => $this->request->getVar('berat_produk'),
            ];
    
            // Memeriksa apakah ada file gambar yang diunggah
            if ($gambar = $this->request->getFile('gambar_produk')) {
                // Memeriksa apakah file gambar yang diunggah valid
                if ($gambar->isValid() && !$gambar->hasMoved()) {
                    // Mendapatkan nama file gambar
                    $namaGambar = $gambar->getRandomName();
                    // Pindahkan file gambar ke direktori yang ditentukan
                    $gambar->move(ROOTPATH . 'public/uploads', $namaGambar);
                    // Tambahkan nama file gambar ke data yang akan disimpan
                    $data['gambar_produk'] = $namaGambar;
                } else {
                    // Jika file gambar tidak valid atau gagal dipindahkan
                    return $this->fail('Invalid image file.');
                }
            }
    
            // Memperbarui data produk
            $model->update($id, $data);
    
            return $this->respondUpdated(['status' => 200, 'message' => 'Product updated successfully.']);
        } else {
            // Jika produk tidak ditemukan
            return $this->failNotFound('Product not found.');
        }
    }
    

public function delete($id = null)
{
    $model = new \App\Models\ProdukModel();

    // Mencari data produk berdasarkan ID
    $produk = $model->find($id);

    // Jika produk ditemukan
    if ($produk) {
        // Menghapus data produk
        $model->delete($id);

        return $this->respondDeleted(['status' => 200, 'message' => 'Product deleted successfully.']);
    } else {
        // Jika produk tidak ditemukan
        return $this->failNotFound('Product not found.');
    }
}


}