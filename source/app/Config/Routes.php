<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

$routes->post('login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout');

$routes->get('system/', 'System::index', ['as' => 'System::index']);
$routes->get('cast', 'Cast::index', ['as' => 'Cast::index']);
$routes->get('coupon/', 'Coupon::index', ['as' => 'Coupon::index']);
$routes->get('diary/', 'Diary::index', ['as' => 'Diary::index']);
$routes->get('diary/detail/(:num)', 'Diary::detail/$1', ['as' => 'Diary::detail']);

$routes->post('register/store/', 'Register::store', ['as' => 'Register::store']);

// フロント用アンケートURL
$routes->get('survey/(:num)', 'Survey::show/$1', ['as' => 'Survey::show']);
$routes->post('survey/submit/(:num)', 'Survey::submit/$1', ['as' => 'Survey::submit']);

// ===============================================
// ★ 管理画面ルーティング (Admin Group)
// ===============================================
$routes->get('admin/login', 'Admin\Login::index', ['as' => 'Admin\Login::index']);
$routes->post('admin/login/attempt', 'Admin\Login::attempt', ['as' => 'Admin\Login::attempt']);
$routes->get('admin/logout', 'Admin\Login::logout', ['as' => 'Admin\Login::logout']);

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'adminAuth'], function($routes)
{
    $routes->get('/', 'Dashboard::index');

    $routes->get('banner/top_index', 'Banner::top_index', ['as' => 'Admin\Banner::top_index']);
    $routes->get('banner/top_new', 'Banner::top_new', ['as' => 'Admin\Banner::top_new']);
    $routes->post('banner/top_store', 'Banner::top_store', ['as' => 'Admin\Banner::top_store']);
    $routes->get('banner/top_delete/(:num)', 'Banner::top_delete/$1', ['as' => 'Admin\Banner::top_delete']);

    $routes->get('users', 'Users::index', ['as' => 'Admin\Users::index']);
    $routes->get('users/edit/(:num)', 'Users::edit/$1', ['as' => 'Admin\Users::edit']);
    $routes->post('users/update/(:num)', 'Users::update/$1', ['as' => 'Admin\Users::update']);

    $routes->get('coupons', 'Coupons::index', ['as' => 'Admin\Coupons::index']);
    $routes->get('coupons/new', 'Coupons::new', ['as' => 'Admin\Coupons::new']);
    $routes->post('coupons/create', 'Coupons::create', ['as' => 'Admin\Coupons::create']);
    $routes->get('coupons/edit/(:num)', 'Coupons::edit/$1', ['as' => 'Admin\Coupons::edit']);
    $routes->post('coupons/update/(:num)', 'Coupons::update/$1', ['as' => 'Admin\Coupons::update']);

    $routes->get('surveys', 'Surveys::index', ['as' => 'Admin\Surveys::index']);
    $routes->get('surveys/new', 'Surveys::new', ['as' => 'Admin\Surveys::new']);
    $routes->post('surveys/create', 'Surveys::create', ['as' => 'Admin\Surveys::create']);
    $routes->get('surveys/edit/(:num)', 'Surveys::edit/$1', ['as' => 'Admin\Surveys::edit']);
    $routes->post('surveys/add_question/(:num)', 'Surveys::addQuestion/$1', ['as' => 'Admin\Surveys::addQuestion']);
    $routes->get('surveys/delete_question/(:num)', 'Surveys::deleteQuestion/$1', ['as' => 'Admin\Surveys::deleteQuestion']);
    $routes->get('surveys/responses/(:num)', 'Surveys::responses/$1', ['as' => 'Admin\Surveys::responses']);

});