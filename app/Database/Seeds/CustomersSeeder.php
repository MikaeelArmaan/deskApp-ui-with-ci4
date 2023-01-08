<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [
            [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'default_address' => 1,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'default_address' => 2,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'default_address' => 3,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'default_address' => 4,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'default_address' => 5,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'default_address' => 6,
                'status'=> 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],

        ];

        $this->db->table('customers')->insertBatch($data);
    }
}
