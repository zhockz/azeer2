<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//login
$routes->match(['get','post'],'/','LoginController::index');
$routes->match(['get','post'],'/reset-password','LoginController::resetPassword');
$routes->match(['get','post'],'/logout','LogoutController::index');

//dashboard
$routes->match(['get','post'],'/dashboard','DashboardController::index');

//profile
$routes->match(['get','post'],'/profile','ProfileController::index');
$routes->match(['get','post'],'/edit-profile','ProfileController::editProfile');

//unathorized
$routes->match(['get','post'],'/unathorized','SettingsController::unathorized');

//settings
$routes->match(['get','post'],'/settings','SettingsController::index');
$routes->match(['get','post'],'/settings/users','SettingsController::userList');
$routes->match(['get','post'],'/settings/users/admin/add','SettingsController::userAdd');
$routes->match(['get','post'],'/settings/users/admin/view','SettingsController::userView');
$routes->match(['get','post'],'/settings/users/admin/edit','SettingsController::userEdit');
$routes->match(['get','post'],'/settings/locations','SettingsController::locations');
$routes->match(['get','post'],'/settings/equipments','SettingsController::equipments');
$routes->match(['get','post'],'/settings/status','SettingsController::status');

//customers
$routes->match(['get','post'],'/customers','CustomersController::index');
$routes->match(['get','post'],'/customers/add','CustomersController::customersAdd');
$routes->match(['get','post'],'/customers/view','CustomersController::customersView');
$routes->match(['get','post'],'/customers/edit','CustomersController::customersEdit');
$routes->match(['get','post'],'/customers/staffs/add','CustomersController::customersStaffsAdd');
$routes->match(['get','post'],'/customers/staffs/edit','CustomersController::customersStaffsEdit');
$routes->match(['get','post'],'/customers/staffs/delete','CustomersController::customersStaffsDelete');
$routes->match(['get','post'],'/customers/equipments','CustomersController::customersEquip');
$routes->match(['get','post'],'/customers/equipments/all','CustomersController::customersAllEquip');
$routes->match(['get','post'],'/customers/equipments/add','CustomersController::customersAddEquip');
$routes->match(['get','post'],'/customers/equipments/view','CustomersController::customersViewEquip');
$routes->match(['get','post'],'/customers/equipments/edit','CustomersController::customersEditEquip');
$routes->match(['get','post'],'/customers/attachments','CustomersController::customersAttach');
$routes->match(['get','post'],'/customers/attachments/delete','CustomersController::customersAttachDelete');

//enginners
$routes->match(['get','post'],'/engineers','EngineersController::index');
$routes->match(['get','post'],'/engineers/add','EngineersController::engineersAdd');
$routes->match(['get','post'],'/engineers/view','EngineersController::engineersView');
$routes->match(['get','post'],'/engineers/edit','EngineersController::engineersEdit');

//task from admin
$routes->match(['get','post'],'/task/new','TaskController::taskNew');
$routes->match(['get','post'],'/task/inprogress','TaskController::taskInProgress');
$routes->match(['get','post'],'/task/completed','TaskController::taskCompleted');
$routes->match(['get','post'],'/task/cancelled','TaskController::taskCancelled');
$routes->match(['get','post'],'/task/view','TaskController::taskView');
$routes->match(['get','post'],'/task/history','TaskController::taskHistory');

//task from customer
$routes->match(['get','post'],'/request/new','TaskController::requestNew');
$routes->match(['get','post'],'/request/inprogress','TaskController::taskInProgress');
$routes->match(['get','post'],'/request/completed','TaskController::taskCompleted');
$routes->match(['get','post'],'/request/cancelled','TaskController::taskCancelled');
$routes->match(['get','post'],'/request/view','TaskController::taskView');

//ajax
$routes->match(['get','post'],'/ajax','AjaxController::index');

//print
$routes->match(['get','post'],'/print','PrintController::index');

//test
$routes->match(['get','post'],'/test','TestController::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
