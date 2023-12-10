<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Searching extends Migration{
    public function up(){

        $this->forge->addField([
            'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true, 'comment' => 'id record'],
            'keyword' => [
                'type'           => 'VARCHAR',
                'constraint' => 225,
                'comment' => 'keyword searching',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('searching', true);
    }

    public function down(){
        $this->forge->dropTable('searching');
    }
}