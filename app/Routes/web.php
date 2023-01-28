<?php

use Fluent\Auth\Facades\Auth;

$routes->get('/', 'HomeController::index', ['as' => 'homepage']);

Auth::routes();

$routes->group('administrator', ['filter' => 'verified'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index', ['as' => 'dashboard.index']);

    $routes->get('profile', 'ProfileController::index', ['as' => 'profile.index']);
    $routes->put('profile', 'ProfileController::update', ['as' => 'profile.update']);

    // User crud routes
    $routes->group('users', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'UserController::index', ['as' => 'users.index', 'filter' => 'permission:account.users.index']);
        $routes->get('data', 'UserController::getData', ['as' => 'users.data', 'filter' => 'permission:account.users.index']);
        $routes->post('/', 'UserController::store', ['as' => 'users.create', 'filter' => 'permission:account.users.create']);
        $routes->put('(:any)/update', 'UserController::store/$1', ['as' => 'users.update', 'filter' => 'permission:account.users.update']);
        $routes->delete('(:any)/delete', 'UserController::destroy/$1', ['as' => 'users.delete', 'filter' => 'permission:account.users.delete']);

        // User role & permission assignment
        $routes->get('(:any)/show', 'UserController::show/$1', ['as' => 'users.show', 'filter' => 'permission:account.users.assign']);
        $routes->put('(:any)/permission', 'UserController::assign/$1', ['as' => 'users.assign', 'filter' => 'permission:account.users.assign']);
    });

    // Role crud routes
    $routes->group('roles', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'RoleController::index', ['as' => 'roles.index', 'filter' => 'permission:access.roles.index']);
        $routes->get('data', 'RoleController::getData', ['as' => 'roles.data', 'filter' => 'permission:access.roles.index']);
        $routes->post('/', 'RoleController::store', ['as' => 'roles.create', 'filter' => 'permission:access.roles.create']);
        $routes->put('(:any)/update', 'RoleController::store/$1', ['as' => 'roles.update', 'filter' => 'permission:access.roles.update']);
        $routes->delete('(:any)/delete', 'RoleController::destroy/$1', ['as' => 'roles.delete', 'filter' => 'permission:access.roles.delete']);

        // Role permission assignment
        $routes->get('(:any)/show', 'RoleController::show/$1', ['as' => 'roles.show', 'filter' => 'permission:access.roles.assign']);
        $routes->put('(:any)/permission', 'RoleController::assign/$1', ['as' => 'roles.assign', 'filter' => 'permission:access.roles.assign']);
    });

    // Role crud routes
    $routes->group('permissions', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'PermissionController::index', ['as' => 'permissions.index', 'filter' => 'permission:access.permissions.index']);
        $routes->get('data', 'PermissionController::getData', ['as' => 'permissions.data', 'filter' => 'permission:access.permissions.index']);
        $routes->post('/', 'PermissionController::store', ['as' => 'permissions.create', 'filter' => 'permission:access.permissions.create']);
        $routes->put('(:any)/update', 'PermissionController::store/$1', ['as' => 'permissions.update', 'filter' => 'permission:access.permissions.update']);
        $routes->delete('(:any)/delete', 'PermissionController::destroy/$1', ['as' => 'permissions.delete', 'filter' => 'permission:access.permissions.delete']);
    });

    // User Logs routes
    $routes->group('activity', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'UserLogableController::index', ['as' => 'activity.index', 'filter' => 'permission:system.activity.index']);
        $routes->get('data', 'UserLogableController::getData', ['as' => 'activity.data', 'filter' => 'permission:system.activity.index']);
        $routes->delete('clear', 'UserLogableController::destroy', ['as' => 'activity.clear', 'filter' => 'permission:system.activity.delete']);
    });

    // Brands routes crud
    $routes->group('brands', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'BrandsController::index', ['as' => 'brands.index', 'filter' => 'permission:modules.brands.index']);
        $routes->get('data', 'BrandsController::getData', ['as' => 'brands.data', 'filter' => 'permission:modules.brands.index']);
        $routes->post('/', 'BrandsController::store', ['as' => 'brands.create', 'filter' => 'permission:modules.brands.create']);
        $routes->put('(:any)/update', 'BrandsController::store/$1', ['as' => 'brands.update', 'filter' => 'permission:modules.brands.update']);
        $routes->delete('(:any)/delete', 'BrandsController::destroy/$1', ['as' => 'brands.delete', 'filter' => 'permission:modules.brands.delete']);
    });

    // Categories routes crud
    $routes->group('categories', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'CategoriesController::index', ['as' => 'categories.index', 'filter' => 'permission:modules.categories.index']);
        $routes->get('data', 'CategoriesController::getData', ['as' => 'categories.data', 'filter' => 'permission:modules.categories.index']);
        $routes->post('/', 'CategoriesController::store', ['as' => 'categories.create', 'filter' => 'permission:modules.categories.create']);
        $routes->put('(:any)/update', 'CategoriesController::store/$1', ['as' => 'categories.update', 'filter' => 'permission:modules.categories.update']);
        $routes->delete('(:any)/delete', 'CategoriesController::destroy/$1', ['as' => 'categories.delete', 'filter' => 'permission:modules.categories.delete']);
    });

    // Products routes crud
    $routes->group('products', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'ProductsController::index', ['as' => 'products.index', 'filter' => 'permission:modules.products.index']);
        $routes->get('data', 'ProductsController::getData', ['as' => 'products.data', 'filter' => 'permission:modules.products.index']);
        $routes->get('create', 'ProductsController::create', ['as' => 'products.create', 'filter' => 'permission:modules.products.create']);
        $routes->post('create', 'ProductsController::store', ['as' => 'products.create', 'filter' => 'permission:modules.products.create']);
        $routes->get('(:num)/edit', 'ProductsController::create/$1', ['as' => 'products.update', 'filter' => 'permission:modules.products.update']);
        $routes->put('(:any)/edit', 'ProductsController::store/$1', ['as' => 'products.update', 'filter' => 'permission:modules.products.update']);
        $routes->delete('(:any)/delete', 'ProductsController::destroy/$1', ['as' => 'products.delete', 'filter' => 'permission:modules.products.delete']);
    });

    // Companies routes crud
    $routes->group('company', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'CompanyController::index', ['as' => 'company.index', 'filter' => 'permission:modules.company.index']);
        $routes->get('data', 'CompanyController::getData', ['as' => 'company.data', 'filter' => 'permission:modules.company.index']);
        $routes->post('/', 'CompanyController::store', ['as' => 'company.create', 'filter' => 'permission:modules.company.create']);
        $routes->put('(:any)/update', 'CompanyController::store/$1', ['as' => 'company.update', 'filter' => 'permission:modules.company.update']);
        $routes->delete('(:any)/delete', 'CompanyController::destroy/$1', ['as' => 'company.delete', 'filter' => 'permission:modules.company.delete']);
    });

    // Customers routes crud
    $routes->group('customers', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'CustomersController::index', ['as' => 'customers.index', 'filter' => 'permission:modules.customers.index']);
        $routes->get('data', 'CustomersController::getData', ['as' => 'customers.data', 'filter' => 'permission:modules.customers.index']);
        $routes->post('/', 'CustomersController::store', ['as' => 'customers.create', 'filter' => 'permission:modules.customers.create']);
        $routes->put('(:any)/update', 'CustomersController::store/$1', ['as' => 'customers.update', 'filter' => 'permission:modules.customers.update']);
        $routes->delete('(:any)/delete', 'CustomersController::destroy/$1', ['as' => 'customers.delete', 'filter' => 'permission:modules.customers.delete']);
    });

    // Orders routes crud
    $routes->group('orders', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'OrdersController::index', ['as' => 'orders.index', 'filter' => 'permission:modules.orders.index']);
        $routes->get('data', 'OrdersController::getData', ['as' => 'orders.data', 'filter' => 'permission:modules.orders.index']);
        $routes->get('create', 'OrdersController::create', ['as' => 'orders.create', 'filter' => 'permission:modules.orders.create']);
        $routes->post('create', 'OrdersController::store', ['as' => 'orders.create', 'filter' => 'permission:modules.orders.create']);
        $routes->get('(:num)/edit', 'OrdersController::create/$1', ['as' => 'orders.update', 'filter' => 'permission:modules.orders.update']);
        $routes->get('(:num)/invoice', 'OrdersController::orderPDF/$1', ['as' => 'orders.invoice', 'filter' => 'permission:modules.orders.invoice']);
        $routes->put('(:any)/edit', 'OrdersController::store/$1', ['as' => 'orders.update', 'filter' => 'permission:modules.orders.update']);
        $routes->delete('(:any)/delete', 'OrdersController::destroy/$1', ['as' => 'orders.delete', 'filter' => 'permission:modules.orders.delete']);
    });

    // Address routes crud
    $routes->group('address', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'AddressController::index', ['as' => 'address.index', 'filter' => 'permission:modules.address.index']);
        $routes->get('data', 'AddressController::getData', ['as' => 'address.data', 'filter' => 'permission:modules.address.index']);
        $routes->post('by', 'AddressController::getAddress', ['as' => 'address.by', 'filter' => 'permission:modules.address.index']);
        $routes->post('/', 'AddressController::store', ['as' => 'address.create', 'filter' => 'permission:modules.address.create']);
        $routes->put('(:any)/update', 'AddressController::store/$1', ['as' => 'address.update', 'filter' => 'permission:modules.address.update']);
        $routes->delete('(:any)/delete', 'AddressController::destroy/$1', ['as' => 'address.delete', 'filter' => 'permission:modules.address.delete']);
    });

    // Site Setting routes crud
    $routes->group('site-settings', ['filter' => 'role:*'], function ($routes) {
        $routes->get('/', 'SitesettingsController::index', ['as' => 'sitesettings.index', 'filter' => 'permission:modules.sitesettings.index']);
        $routes->get('data', 'SitesettingsController::getData', ['as' => 'sitesettings.data', 'filter' => 'permission:modules.sitesettings.index']);
        $routes->get('create', 'SitesettingsController::create', ['as' => 'sitesettings.create', 'filter' => 'permission:modules.sitesettings.create']);
        $routes->post('create', 'SitesettingsController::store', ['as' => 'sitesettings.create', 'filter' => 'permission:modules.sitesettings.create']);
        $routes->get('(:num)/edit', 'SitesettingsController::create/$1', ['as' => 'sitesettings.update', 'filter' => 'permission:modules.sitesettings.update']);
        $routes->put('(:any)/edit', 'SitesettingsController::store/$1', ['as' => 'sitesettings.update', 'filter' => 'permission:modules.sitesettings.update']);
        $routes->delete('(:any)/delete', 'SitesettingsController::destroy/$1', ['as' => 'sitesettings.delete', 'filter' => 'permission:modules.sitesettings.delete']);
    });
});
