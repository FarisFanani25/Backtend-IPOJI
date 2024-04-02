<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdukMigrasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'harga_produk' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'deskripsi_produk' => [
                'type' => 'TEXT',
            ],
            'stok_tersedia' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'berat_produk' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'gambar_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->addKey('id_produk', true);
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
