<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration{
    public function up(){

        // Uncomment below if want config
        $this->forge->addField([
            'id_kategori'          		=> [
                    'type'           => 'INT',
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
            ],
            'nama_kategori'       		=> [
                    'type'           => 'VARCHAR',
                    'constraint'     => '15',
                    'unique'            => true
            ],
            'slug'       		=> [
                'type'           => 'VARCHAR',
                'constraint'     => '15',
            ],
            'status'       		=> [
                'type'           => 'INT',
                'constraint'     => '1',
                'default'       => true,
                'comment'       => "(status kategori)\n1/true: kategori aktif\n0/false: kategori terhapus"
            ],
        ]);
        $this->forge->addKey('id_kategori', TRUE);
        $this->forge->createTable('kategori');

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
                'comment' => 'ID record',
            ],
            'id_kategori' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'comment' => 'ID kategori',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('record_kategori', true);
    }

    public function down(){
        $this->forge->dropTable('kategori');
        $this->forge->dropTable('record_kategori');
    }
}