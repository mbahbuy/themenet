<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konten extends Migration{
    public function up(){

        // Uncomment below if want config
        $this->forge->addField([
            'id_konten'          		=> [
                    'type'           => 'INT',
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
            ],
            'id_judul'              => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'sequence'              => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
            ],
            'konten'       		=> [
                    'type'           => 'VARCHAR',
                    'constraint'     => '1024',
            ],
        ]);

        $this->forge->addKey('id_konten', true); // Primary key
        // $this->forge->addKey('id_judul'); // Index on id_judul

        // $this->forge->addForeignKey('id_judul', 'judul', 'id_judul'); // Foreign key to judul table
        $this->forge->createTable('konten');
    }

    public function down(){
        $this->forge->dropTable('konten');
    }
}