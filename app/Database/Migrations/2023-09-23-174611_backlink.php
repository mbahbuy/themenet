<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Backlink extends Migration{
    public function up(){

        $this->forge->addField([
            'id_backlink' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
                'comment' => 'primarykey backlink untuk keperluan editing',
            ],
            'id_judul' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'id_judul dari artikel',
            ],
            'backlink' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'baca juga id_judul artikel ini',
            ],
        ]);

        $this->forge->addKey('id_backlink', true); // Primary key
        $this->forge->addUniqueKey('id_backlink'); // Unique key
        // $this->forge->addKey('backlink'); // Invisible index
        // $this->forge->addKey('id_judul'); // Index on id_judul

        // $this->forge->addForeignKey('id_judul', 'judul', 'id_judul'); // Foreign key to judul table
        // $this->forge->addForeignKey('backlink', 'judul', 'id_judul'); // Foreign key to judul table

        $this->forge->createTable('backlink', true);
    }

    public function down(){
        $this->forge->dropTable('backlink');
    }
}