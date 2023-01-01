<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Car Batteries',
                'status' => 1,
                'sequence' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Inverter Batteries',
                'status' => 1,
                'sequence' => 2,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => '2 Wheeler Batteries',
                'status' => 1,
                'sequence' => 3,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Inverter/UPS',
                'status' => 1,
                'sequence' => 4,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Solar Inverter/UPS',
                'status' => 1,
                'sequence' => 5,
                'created_at' => date("Y-m-d H:i:s")
            ],

        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
