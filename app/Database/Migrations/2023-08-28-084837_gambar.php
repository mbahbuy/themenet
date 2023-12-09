<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Gambar extends Migration{
    public function up(){

        // Uncomment below if want config
        $this->forge->addField([
        		'picture'          		=> [
        				'type'           => 'VARCHAR',
                        'constraint' => '50',
        		],
        		'ukuran'       		=> [
        				'type'           => 'DECIMAL',
        				'constraint'     => '8,4',
                        'unsigned' => true
        		],
        ]);
        $this->forge->addKey('picture', TRUE);
        $this->forge->createTable('gambar');
    }

    public function down(){
        $this->forge->dropTable('gambar');
    }
}