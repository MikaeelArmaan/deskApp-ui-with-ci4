<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AddressSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [
            [
                'belongsto_id' => 1,
                'type' => 1,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'belongsto_id' => 1,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'belongsto_id' => 2,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'belongsto_id' => 2,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'belongsto_id' => 3,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'belongsto_id' => 3,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'belongsto_id' => 3,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'belongsto_id' => 4,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'belongsto_id' => 5,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 2,
                'belongsto_id' => 1,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 3,
                'belongsto_id' => 1,
                'address1' => $faker->buildingNumber . $faker->streetName,
                'address2' => $faker->address,
                'locality' => $faker->streetAddress,
                'city' => $faker->city,
                'pincode' => $faker->postcode,
                'state' => 'Maharashtra',
                'country' => 'India',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ];

        $this->db->table('address')->insertBatch($data);
    }
}
