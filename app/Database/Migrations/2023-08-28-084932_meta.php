<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Meta extends Migration{
    public function up(){

        // Table meta
        $this->forge->addField([
        		'id_meta'          		=> [
        				'type'           => 'INT',
        				'unsigned'       => TRUE,
        				'auto_increment' => TRUE,
                        'comment' => 'primarykey daftar meta',
        		],
        		'meta'       		=> [
        				'type'           => 'VARCHAR',
        				'constraint'     => '225',
                        'comment'       => 'nama meta',
        		],
                'slug'       		=> [
                    'type'           => 'VARCHAR',
                    'constraint'     => '225',
                    'comment'       => 'slug untuk pencarian di frontend',
                ],
        ]);
        $this->forge->addKey('id_meta', true); // Primary key
        $this->forge->addUniqueKey('id_meta'); // Unique key
        // $this->forge->addUniqueKey('meta'); // Unique key
        $this->forge->createTable('meta');

        // Table relasi_meta
        $this->forge->addField([
            'id_meta'       		=> [
                    'type'           => 'INT',
                    'unsigned' => true,
                    'comment'       => 'id_meta yang mana',
            ],
            'id_judul'       		=> [
                'type'           => 'INT',
                'unsigned' => true,
                'comment'       => 'adalah meta dari id_judul yang mana',
            ],
        ]);
        // $this->forge->addKey('id_meta'); // Index on id_meta
        // $this->forge->addKey('id_judul'); // Index on id_judul

        // $this->forge->addForeignKey('id_judul', 'judul', 'id_judul'); // Foreign key to judul table
        // $this->forge->addForeignKey('id_meta', 'meta', 'id_meta'); // Foreign key to meta table
        $this->forge->createTable('relasi_meta');

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
                'comment' => 'ID record',
            ],
            'id_meta' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'comment' => 'ID kategori',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('record_meta', true);
    }

    public function down(){
        $this->forge->dropTable('meta');
        $this->forge->dropTable('relasi_meta');
        $this->forge->dropTable('record_meta');
    }
}