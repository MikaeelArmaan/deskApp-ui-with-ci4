<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoriesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            
            'short_description' => [
                'type' => 'text',
                'null' => true
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'sequence' => [
                'type'       => 'INT',
                'constraint' => 10,
                'default'    => 9999,
            ],
            'status' => [
                'type'       => 'INT',
                'constraint' => 2,
                'default'    => 0,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        
        $this->forge->createTable('categories', true);
    }

    public function down()
    {
        $this->forge->dropTable('categories', true);
    }
}
