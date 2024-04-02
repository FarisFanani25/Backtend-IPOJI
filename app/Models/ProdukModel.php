<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $returnType = ProdukModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nama_produk', 'harga_produk', 'deskripsi_produk', 'stok_tersedia', 'berat_produk', 'gambar_produk'];
}