<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdersMigration extends Migration
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
            'invoice_no' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            'invoice_date' => [
                'type' => 'date',
                'null' => true
            ],
            'delivery_date' => [
                'type' => 'date',
                'null' => true
            ],
            'customer_id' => [
                'type' => 'int',
                'constraint' => 20,
                'null' => true
            ],
            'shipping_address_id' => [
                'type' => 'int',
                'constraint' => 20,
                'null' => true
            ],
            'billing_address_id' => [
                'type' => 'int',
                'constraint' => 20,
                'null' => true
            ],
            'gst_number' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ],
            'currently_paid' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'current_balance' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'product_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'gst_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'discount_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'grand_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true
            ],
            'notes' => [
                'type' => 'TEXT',
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
            'created_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'updated_by' => [
                'type' => 'INT',
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
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('shipping_address_id', 'address', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('billing_address_id', 'address', 'id', 'CASCADE', 'CASCADE');


        $this->forge->createTable('orders', true);
    }

    public function down()
    {
        $this->forge->dropTable('orders', true);
    }
}
