<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Audi Cars',
                'status' => 1,
                //'sequence' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'BMW India Pvt Ltd',
                'status' => 1,
                //'sequence' => 2,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Chevrolet',
                'status' => 1,
                //'sequence' => 3,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Fiat',
                'status' => 1,
                //'sequence' => 4,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Force Motors',
                'status' => 1,
                //'sequence' => 5,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Ford',
                'status' => 1,
                //'sequence' => 6,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Honda',
                'status' => 1,
                //'sequence' => 7,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Hyundai',
                'status' => 1,
                //'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Tata Motors',
                'status' => 1,
                //'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Toyota',
                'status' => 1,
                //'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Volkswagen',
                'status' => 1,
                //'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Volvo Auto India',
                'status' => 1,
                //'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Skoda',
                'status' => 1,
                //'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Renault India',
                'status' => 1,
                //'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Others',
                'status' => 1,
                //'sequence' => 8,
                'created_at' => date("Y-m-d H:i:s")
            ],


        ];

        $this->db->table('company')->insertBatch($data);
    }
}
