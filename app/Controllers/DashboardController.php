<?php

namespace App\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\SitesettingsModel;
use App\Models\User;
use App\Models\UserLogable;

class DashboardController extends BaseController
{
	protected $sitesettingmodel;

	function __construct()
	{
		$this->sitesettingmodel = new SitesettingsModel();
		if (auth()->id() != 1) {
			$siteSetting = $this->sitesettingmodel->getSiteSettingByUserId(auth()->id());
		}
		
	}

	public function index()
	{
		$roles = Role::count();
		$permissions = Permission::count();
		$activities = UserLogable::count();
		$users = User::count();

		return render('dashboard', compact('roles', 'permissions', 'activities', 'users'));
	}

	//--------------------------------------------------------------------

}
