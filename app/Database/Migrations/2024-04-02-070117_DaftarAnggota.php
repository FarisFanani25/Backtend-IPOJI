<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTambahAnggotaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_anggota' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nomor_hp' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'tanggal_setoran' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jumlah_setor' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id'); // Tambahkan 'id' sebagai primary key
        $this->forge->createTable('tambah_anggota');
    }

    public function down()
    {
        $this->forge->dropTable('tambah_anggota');
    }
}
