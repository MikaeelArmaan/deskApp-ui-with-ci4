<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BrandsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'TATA Green',
                'status' => 1,
                'sequence' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Amaron',
                'status' => 1,
                'sequence' => 2,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'DYNEX',
                'status' => 1,
                'sequence' => 3,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Exide',
                'status' => 1,
                'sequence' => 4,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Livfast',
                'status' => 1,
                'sequence' => 5,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Livguard',
                'status' => 1,
                'sequence' => 6,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Powerzone',
                'status' => 1,
                'sequence' => 7,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'SF Sonic',
                'status' => 1,
                'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],
           

        ];

        $this->db->table('brands')->insertBatch($data);
    }
}
