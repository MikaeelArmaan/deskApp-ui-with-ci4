<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModuleSeeder extends Seeder
{
	public function run()
	{
		$this->call(BrandsSeeder::class);
		$this->call(CategoriesSeeder::class);
		$this->call(CompanySeeder::class);
		$this->call(ProductsSeeder::class);
		$this->call(CustomersSeeder::class);
		$this->call(AddressSeeder::class);
	}
}
