<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('register', 'Register::index');
$routes->post('register/save', 'Register::save');
$routes->get('register/success', 'Register::success');

$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/login/success', 'Login::success');
$routes->get('/login/logout', 'Login::logout');


$routes->group('api', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->post('register', 'Register::save');
    $routes->post('login', 'Login::authenticate');
});
