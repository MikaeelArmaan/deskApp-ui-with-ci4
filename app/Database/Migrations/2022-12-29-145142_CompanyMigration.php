<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CompanyMigration extends Migration
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
            'gst' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            'telephone' => [
                'type' => 'varchar',
                'constraint' => 14,
                'null' => true
            ],
            'image' => [
                'type' => 'text',
                'null' => true,
            ],
            'default_address' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true
            ],
            'status' => [
                'type'       => 'INT',
                'constraint' => 2,
                'default'    => 0,
            ],
            'created_at' => [
            	'type' => 'datetime',
            	'null' => true
            ],
            'updated_at' => [
            	'type' => 'datetime',
            	'null' => true
            ],
            'deleted_at' => [
            	'type' => 'datetime',
            	'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('default_address', 'address', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('company', true);
    }
    public function down()
    {
        $this->forge->dropTable('company', true);
    }
}
