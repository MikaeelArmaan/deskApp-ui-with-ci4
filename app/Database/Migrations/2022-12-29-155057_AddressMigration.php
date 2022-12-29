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
                'auto_increment' => true
            ],
            'address1' => [
                'type' => 'text'
            ],
            'address2' => [
                'type' => 'text',
                'null' => true
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
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('address', true);
    }

    public function down()
    {
        $this->forge->dropTable('address', true);
    }
}
