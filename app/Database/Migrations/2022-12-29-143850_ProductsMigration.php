<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsMigration extends Migration
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
            'category_id' => [
                'type' => 'int',
                'constraint' => 20,
                'null' => true
            ],
            'brand_id' => [
                'type' => 'int',
                'constraint' => 20,
                'null' => true
            ],
            'image' => [
                'type' => 'text',
                'null' => true
            ],
            'short_description' => [
                'type' => 'text',
                'null' => true
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'hsn' => [
                'type' => 'varchar',
                'constraint' => 15,
                'null' => true
            ],
            'cgst' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE,
                'default' => 2.50
            ],
            'sgst' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE,
                'default' => 2.50
            ],
            'stock' => [
                'type'       => 'INT',
                'constraint' => 10,
                'default'    => 0,
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
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('brand_id', 'brands', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('products', true);
    }

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
