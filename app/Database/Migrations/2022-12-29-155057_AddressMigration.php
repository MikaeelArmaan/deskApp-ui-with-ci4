<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddressMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'belongsto_id' => [
                'type' => 'INT',
                'constraint' => 4,
                'COMMENT' => '1-Customers id,2-company id,3-billing address id,4-shipping address id',
            ],
            'type' => [
                'type' => 'INT',
                'constraint' => 4,
                'COMMENT' => '1-Customers,2-company,3-billing,4-shipping',
            ],
            'address1' => [
                'type' => 'text',
                'null' => true,
            ],
            'address2' => [
                'type' => 'text',
                'null' => true,
            ],
            'locality' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true,
            ],
            'city' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true,
            ],
            'pincode' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true,
            ],
            'state' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true,
            ],
            'country' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true,
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

        $this->forge->createTable('address', true);
    }

    public function down()
    {
        $this->forge->dropTable('address', true);
    }
}
