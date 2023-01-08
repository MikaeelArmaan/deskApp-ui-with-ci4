<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
	public function run()
	{
		$permissions = [
			'system' => [
				'activity' => [
					'index'  => 'Can read user\'s activity logs',
					'delete' => 'Can delete user\'s activity logs'
				]
			],
			'account' => [
				'users' => [
					'index'  => 'Can read users data',
					'create' => 'Can create users data',
					'update' => 'Can update users data',
					'delete' => 'Can delete users data',
					'assign' => 'Can assign user\'s role & permission'
				],
			],
			'access' => [
				'roles' => [
					'index'  => 'Can read roles data',
					'create' => 'Can create roles data',
					'update' => 'Can update roles data',
					'delete' => 'Can delete roles data',
					'assign' => 'Can assign role\'s permission'
				],
				'permissions' => [
					'index'  => 'Can read permissions data',
					'create' => 'Can create permissions data',
					'update' => 'Can update permissions data',
					'delete' => 'Can delete permissions data'
				],
			],
			'modules' => [
				'brands' => [
					'index'  => 'Can read brands data',
					'create' => 'Can create brands data',
					'update' => 'Can update brands data',
					'delete' => 'Can delete brands data'
				],
				'products' => [
					'index'  => 'Can read products data',
					'create' => 'Can create products data',
					'update' => 'Can update products data',
					'delete' => 'Can delete products data'
				],
				'address' => [
					'index'  => 'Can read address data',
					'create' => 'Can create address data',
					'update' => 'Can update address data',
					'delete' => 'Can delete address data'
				],
				'categories' => [
					'index'  => 'Can read categories data',
					'create' => 'Can create categories data',
					'update' => 'Can update categories data',
					'delete' => 'Can delete categories data'
				],
				'customers' => [
					'index'  => 'Can read customers data',
					'create' => 'Can create customers data',
					'update' => 'Can update customers data',
					'delete' => 'Can delete customers data'
				],
				'company' => [
					'index'  => 'Can read company data',
					'create' => 'Can create company data',
					'update' => 'Can update company data',
					'delete' => 'Can delete company data'
				],
				'orders' => [
					'index'  => 'Can read Orders data',
					'create' => 'Can create Orders data',
					'update' => 'Can update Orders data',
					'delete' => 'Can delete Orders data'
				],
			],
			'main' => [
				// when the menu doesn't have group insert it into here
				// for example the dashboard menu bellow
				'dashboard' => [
					'index' => 'Can see dashboard page'
				]
			]
		];

		$data = [];
		foreach ($permissions as $group => $groups) {
			foreach ($groups as $menu => $menus) {
				foreach ($menus as $index => $value) {
					$data[] = [
						'name' 			=> $group . '.' . $menu . '.' . $index,
						'readable_name' => $value,
						'created_at' => date("Y-m-d H:i:s")
					];
				}
			}
		}

		$this->db->table('permissions')->insertBatch($data);
	}
}
