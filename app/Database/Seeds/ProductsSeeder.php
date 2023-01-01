<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 20; $i++) {
            $data = [
                'name' =>  'TATA GREEN ' . $faker->name(),
                'category_id' =>  $i,
                'brand_id ' =>  $i,
                'short_description ' =>  $faker->text(100),
                'description ' =>  $faker->text(250),
                'hsn ' =>  '85068' . $i,
                'gst ' =>  18,
                'retailer_price ' => $faker->numberBetween(900, 1000),
                'distributor_price ' => $faker->numberBetween(600, 800),
                'purchase_price ' => $faker->numberBetween(500, 600),
                'sale_price ' => $faker->numberBetween(1100, 2000),
                'quantity ' =>  $faker->numberBetween(100, 150),
                'status' => 1,
                'sequence' => $i,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            $this->db->table('products')->insert($data);
        }
    }
}
