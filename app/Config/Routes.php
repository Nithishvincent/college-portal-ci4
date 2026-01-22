<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('welcome', 'welcome::index');
$routes->get('student', 'Student::index');
$routes->get('college', 'College::index');
$routes->post('student/save', 'Student::save');
$routes->get('student/list', 'Student::list');
$routes->get('login', 'Login::index');
$routes->post('login/check', 'Login::check');
$routes->get('logout', 'Login::logout');
//$routes->get('dashboard', 'Dashboard::index');
$routes->get('student/edit/(:num)', 'Student::edit/$1');
$routes->post('student/update/(:num)', 'Student::update/$1');
$routes->get('student/flag/(:num)', 'Student::flag/$1');
$routes->get('admin', 'Admin::index');
$routes->get('admin/users', 'Admin::users');
//project routes
$routes->get('project', 'Project::index');
$routes->post('project/save', 'Project::save');
$routes->get('project/list', 'Project::list');
//evaluation routes
$routes->get('evaluation/(:num)', 'Evaluation::evaluate/$1');
$routes->post('evaluation/save', 'Evaluation::save');
$routes->get('faculty/student/(:num)', 'Faculty::studentDetail/$1');
$routes->get('evaluation/edit/(:num)', 'Evaluation::edit/$1');
$routes->post('evaluation/update/(:num)', 'Evaluation::update/$1');
//admin dashboard
$routes->get('admin/dashboard', 'Dashboard::admin');
//user management
$routes->get('users', 'User::index');
$routes->post('users/update', 'User::update');
$routes->post('users/store', 'User::store');
//dashboard routes
// Entry dashboard (router)
$routes->get('dashboard', 'Dashboard::index');
// Role dashboards
$routes->get('admin/dashboard', 'Dashboard::admin');
$routes->get('faculty/dashboard', 'Dashboard::faculty');
$routes->get('student/dashboard', 'Dashboard::student');
//create user
$routes->get('admin/student/create', 'AdminStudent::create');
$routes->post('admin/student/store', 'AdminStudent::store');
//password reset
$routes->get('password/change', 'Password::change');
$routes->post('password/update', 'Password::update');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
