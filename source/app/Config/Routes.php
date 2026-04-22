<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Index::index');
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
$routes->get('top/', 'Index::top', ['as' => 'Index::top']);

$routes->post('login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout');

$routes->get('system/', 'System::index', ['as' => 'System::index']);
$routes->get('cast', 'Cast::index', ['as' => 'Cast::index']);
$routes->get('cast/detail/(:num)', 'Cast::detail/$1', ['as' => 'Cast::detail']);
$routes->get('coupon/', 'Coupon::index', ['as' => 'Coupon::index']);
$routes->get('schedule', 'Schedule::index', ['as' => 'Schedule::index']);
$routes->get('diary/', 'Diary::index', ['as' => 'Diary::index']);
$routes->get('diary/detail/(:num)', 'Diary::detail/$1', ['as' => 'Diary::detail']);

$routes->post('register/store', 'Auth::registerStore');
// $routes->post('register/store/', 'Register::store', ['as' => 'Register::store']);

$routes->post('register', 'Auth::register');
$routes->get('activate/(:any)', 'Auth::activate/$1');
$routes->post('login', 'Auth::login');

$routes->get('forgot-password', 'Auth::forgotPasswordView');
$routes->post('forgot-password', 'Auth::forgotPasswordStore');
$routes->get('password/reset/(:any)', 'Auth::passwordResetView/$1');
$routes->post('password/update', 'Auth::passwordUpdate');
// フロント用アンケートURL
$routes->get('survey/(:num)', 'Survey::show/$1', ['as' => 'Survey::show']);
$routes->post('survey/submit/(:num)', 'Survey::submit/$1', ['as' => 'Survey::submit']);
// フロント側のルートグループ等に追記
$routes->get('hotels', 'Hotels::index');
// app/Config/Routes.php に一時的に追加
// $routes->get('create-staff', function() {
//     $db = \Config\Database::connect();
//     $builder = $db->table('admins');
    
//     $data = [
//         'username'   => 'staff_user', // ログイン用ID
//         'password'   => password_hash('staff1234', PASSWORD_DEFAULT), // ここで安全な暗号に変換！
//         'role'       => 'staff',      // 権限をスタッフに
//         'created_at' => date('Y-m-d H:i:s')
//     ];
    
//     $builder->insert($data);
//     return 'スタッフアカウント（staff_user / staff1234）の作成が完了しました！このルートは削除してね！';
// });
// ===============================================
// ★ 管理画面ルーティング (Admin Group)
// ===============================================
$routes->get('admin/login', 'Admin\Login::index', ['as' => 'Admin\Login::index']);
$routes->post('admin/login/attempt', 'Admin\Login::attempt', ['as' => 'Admin\Login::attempt']);
$routes->get('admin/logout', 'Admin\Login::logout', ['as' => 'Admin\Login::logout']);

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'adminAuth'], function($routes)
{
    $routes->get('/', 'Dashboard::index');
    $routes->get('settings', 'Settings::index', ['as' => 'admin_settings_index']);
    $routes->post('settings/update', 'Settings::update', ['as' => 'admin_settings_update']);

    $routes->get('banner/index', 'Banner::index', ['as' => 'Admin\Banner::index']);
    $routes->get('banner/new', 'Banner::new', ['as' => 'Admin\Banner::new']);
    $routes->post('banner/create', 'Banner::create', ['as' => 'Admin\Banner::create']);
    $routes->get('banner/delete/(:num)', 'Banner::delete/$1', ['as' => 'Admin\Banner::delete']);
    $routes->post('banner/reorder', 'Banner::reorder', ['as' => 'Admin\Banner::reorder']);

    $routes->get('users', 'Users::index', ['as' => 'Admin\Users::index']);
    $routes->get('users/edit/(:num)', 'Users::edit/$1', ['as' => 'Admin\Users::edit']);
    $routes->post('users/update/(:num)', 'Users::update/$1', ['as' => 'Admin\Users::update']);
    
    $routes->get('hotels', 'Hotels::index', ['as' => 'Admin\Hotels::index']);
    $routes->post('hotels/store', 'Hotels::store', ['as' => 'Admin\Hotels::store']);
    $routes->get('hotels/delete/(:num)', 'Hotels::delete/$1', ['as' => 'Admin\Hotels::delete']);
    $routes->get('hotels/edit/(:num)', 'Hotels::edit/$1', ['as' => 'Admin\Hotels::edit']);
    $routes->post('hotels/update/(:num)', 'Hotels::update/$1', ['as' => 'Admin\Hotels::update']);

    $routes->get('coupons', 'Coupons::index', ['as' => 'Admin\Coupons::index']);
    $routes->get('coupons/new', 'Coupons::new', ['as' => 'Admin\Coupons::new']);
    $routes->post('coupons/create', 'Coupons::create', ['as' => 'Admin\Coupons::create']);
    $routes->get('coupons/edit/(:num)', 'Coupons::edit/$1', ['as' => 'Admin\Coupons::edit']);
    $routes->post('coupons/update/(:num)', 'Coupons::update/$1', ['as' => 'Admin\Coupons::update']);

    $routes->get('surveys', 'Surveys::index', ['as' => 'Admin\Surveys::index']);
    $routes->get('surveys/new', 'Surveys::new', ['as' => 'Admin\Surveys::new']);
    $routes->post('surveys/create', 'Surveys::create', ['as' => 'Admin\Surveys::create']);
    $routes->get('surveys/edit/(:num)', 'Surveys::edit/$1', ['as' => 'Admin\Surveys::edit']);
    $routes->post('surveys/update/(:num)', 'Surveys::update/$1', ['as' => 'Admin\Surveys::update']);
    $routes->get('surveys/delete/(:num)', 'Surveys::delete/$1', ['as' => 'Admin\Surveys::delete']);
    $routes->get('surveys/publish/(:num)', 'Surveys::publish/$1', ['as' => 'Admin\Surveys::publish']);
    $routes->post('surveys/add_question/(:num)', 'Surveys::addQuestion/$1', ['as' => 'Admin\Surveys::addQuestion']);
    $routes->get('surveys/delete_question/(:num)', 'Surveys::deleteQuestion/$1', ['as' => 'Admin\Surveys::deleteQuestion']);
    $routes->get('surveys/responses/(:num)', 'Surveys::responses/$1', ['as' => 'Admin\Surveys::responses']);
    $routes->post('surveys/reorder', 'Surveys::reorder', ['as' => 'Admin\Surveys::reorder']);

    $routes->get('transport_fees', 'TransportFees::index', ['as' => 'Admin\TransportFees::index']);
    $routes->post('transport_fees/store', 'TransportFees::store', ['as' => 'Admin\TransportFees::store']);
    $routes->get('transport_fees/delete/(:num)', 'TransportFees::delete/$1', ['as' => 'Admin\TransportFees::delete']);
});