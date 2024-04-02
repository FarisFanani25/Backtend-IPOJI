<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarAnggotaModel extends Model
{
    protected $table = 'tambah_anggota';
    protected $primaryKey = 'id_anggota'; // Menetapkan kolom 'id' sebagai primary key
    protected $allowedFields = ['nama_anggota', 'alamat', 'nomor_hp', 'tanggal_setoran', 'jumlah_setor'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
