<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Templates extends Migration{
    public function up(){

        // Uncomment below if want config
        $this->forge->addField([
            'id_template'          		=> [
                    'type'           => 'INT',
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
            ],
            'template'          => [
                'type'          => 'VARCHAR',
                'constraint'    => '225',
                'comment'       => 'nama folder dari template.'
            ],
            'location'          => [
                'type'          => 'VARCHAR',
                'constraint'    => '225',
                'comment'       => 'direction ke tempat penyimpanan template.'
            ],
        ]);
        $this->forge->addKey('id_template', TRUE);
        $this->forge->createTable('templates');

        // $this->forge->addField([
        //     'id_template'          		=> [
        //         'type'           => 'INT',
        //         'unsigned' => true,
        //     ],
        //     'status'            => [
        //         'type'          => 'INT',
        //         'constraint'     => '1',
        //         'default'       => true,
        //         'comment'       => 'true/angka 1 : menunjukan pada template yang di pakai, false/angka 0 : menunjukan bahwa template tidak dipakai'
        //     ],
        // ]);
        // $this->forge->createTable('templates_active');
    }

    public function down(){
        $this->forge->dropTable('templates');
        // $this->forge->dropTable('templates_active');
    }
}