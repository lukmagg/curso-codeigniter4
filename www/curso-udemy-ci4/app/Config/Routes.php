<?php

namespace Config;

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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('contacto', 'Home::contacto');
$routes->get('contactarme/(:any)', 'Home::contacto/$1', ['as' => 'contacto']);
$routes->get('category', 'dashboard/CategoryController::index');
$routes->get('image', 'Home::image');
$routes->get('image/(:num)/(:any)', 'Home::image/$1/$2', ['as' => 'get_image']);
$routes->get('/movie/image/(:num)', 'Movie::delete_image/$1', ['as' => 'image_delete']);

$routes->group('dashboard', function($routes)
{
	
	/* $routes->get('movie', 'dashboard/MovieController::index');
	$routes->get('movie/test/(:any)', 'dashboard/MovieController::test/$1');
	$routes->get('movie/show', 'dashboard/MovieController::show'); */
});

$routes->resource('movie');









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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
