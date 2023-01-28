<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SitesettingsMigration extends Migration
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
            'site_name' => [
                'type' => 'varchar',
                'constraint' => 20,
                'default' => "DeskApp"
            ],
            'site_admin' => [
                'type' => 'int',
                'constraint' => 20,
                'null' => true
            ],
            'headercolor' => [
                'type' => 'varchar',
                'constraint' => 50,
                'default' => 'header-dark'
            ],
            'sidebarcolor' => [
                'type' => 'varchar',
                'constraint' => 20,
                'default' => 'sidebar-dark'
            ],
            'menu_icon' => [
                'type' => 'int',
                'constraint' => 3,
                'default' => 1
            ],
            'menu_icon_list' => [
                'type' => 'int',
                'constraint' => 3,
                'default' => 1
            ],
            'gst_number' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ],
            'pan_number' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ],
            'tan_number' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => true
            ],
            'email' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'mobiles' => [
                'type' => 'JSON',
                'null' => true
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'bank_name' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'bank_account' => [
                'type' => 'int',
                'constraint' => '20',
                'null' => true
            ],
            'ifsc' => [
                'type' => 'varchar',
                'constraint' => '15',
                'null' => true
            ],
            'branch' => [
                'type' => 'varchar',
                'constraint' => '20',
                'null' => true
            ],
            'logo' => [
                'type' => 'varchar',
                'constraint' => 100,
                'default' => 'logo.png'
            ],
            'bill_watermark' => [
                'type' => 'varchar',
                'constraint' => 100,
                'default' => 'watermark.png'
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
       
        $this->forge->createTable('sitesettings', true);
    }

    public function down()
    {
        $this->forge->dropTable('sitesettings', true);
    }
}
