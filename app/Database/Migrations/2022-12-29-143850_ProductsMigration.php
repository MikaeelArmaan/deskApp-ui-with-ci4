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
            'quantity' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true
            ],
            'retailer_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'distributor_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'purchase_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'sale_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
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
            'gst' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE,
                'default' => 2.50
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
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('brand_id', 'brands', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('products', true);
    }

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
