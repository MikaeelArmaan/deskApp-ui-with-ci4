<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderproductsMigration extends Migration
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
            'order_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true
            ],
            'product_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true
            ],
            'quantity' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'gst_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'discount_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('orderproducts', true);
    }

    public function down()
    {
        $this->forge->dropTable('orderproducts', true);
    }
}
