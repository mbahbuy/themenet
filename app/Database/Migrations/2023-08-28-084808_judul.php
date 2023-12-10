<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Judul extends Migration{
    public function up(){

        $this->forge->addField([
            'id_judul' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
                'comment' => 'ID article',
            ],
            'id_kategori' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'comment' => 'ID kategori',
            ],
            'user_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'comment' => 'ID user',
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment' => 'judul article',
            ],
            'meta_keyword' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
                'comment' => 'meta keyword',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment' => 'sub-judul article',
            ],
            'picture' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
                'comment' => 'foreign key nama gambar'
            ],
            'konten_singkat' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '1',
                'default' => 'D',
                'comment' => "status artikel:\n\nD : Draft\nP : Publish\nF: Future\nR: Removed"
            ],
            'waktu_status' => [
                'type'       => 'DATETIME',
                'null' => true,
                'comment' => 'waktu status',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'comment' => 'waktu pembuatan',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'comment' => 'waktu pembuatan',
            ],
        ]);
        $this->forge->addKey('id_judul', true); // Primary key
        $this->forge->addUniqueKey('id_judul'); // Unique key
        // $this->forge->addKey('id_kategori'); // Index on id_kategori
        // $this->forge->addKey('user_hash'); // Index on user_hash
        // $this->forge->addKey('picture'); // Index on picture

        // $this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori'); // Foreign key to kategori table
        // $this->forge->addForeignKey('user_hash', 'users', 'user_hash'); // Foreign key to penulis table
        // $this->forge->addForeignKey('picture', 'gambar', 'picture'); // Foreign key to gambar table

        $this->forge->createTable('judul', true);

        $this->forge->addField([
            'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true, 'comment' => 'id record'],
            'id_judul' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'comment' => 'ID article',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('record_judul', true);

    }

    public function down(){
        $this->forge->dropTable('judul');
        $this->forge->dropTable('record_judul');
    }
}