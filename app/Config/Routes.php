<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'BlogController::index');
$routes->get('blog/detail/(:num)', 'BlogController::detail/$1');
$routes->get('blog/tambah', 'BlogController::create');
$routes->post('blog/store', 'BlogController::store');
$routes->get('blog/about', 'BlogController::about');