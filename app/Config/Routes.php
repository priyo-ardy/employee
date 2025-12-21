<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Auth\AuthController::index', ['filter' => 'ratelimit:30,60']);
$routes->post('/login', 'Auth\AuthController::processLogin', ['filter' => 'ratelimit:5,60']);
$routes->get('/forgot-password', 'Auth\AuthController::forgotPassword', ['filter' => 'ratelimit:10,60']);
$routes->post('/reset-password', 'AppSetup\Email\EmailController::resetPassword', ['filter' => 'ratelimit:5,60']);
$routes->get('/logout', 'Auth\AuthController::logOut');


$routes->group('', ['filter' => ['auth', 'ratelimit:100,60']], static function ($routes) {
    // Dashboard page
    $routes->get('/dashboard', 'Dashboard\DashboardController::index');

    // Users management
    $routes->group('users', static function ($routes) {
        $routes->get('', 'AppSetup\Users\UserController::index');
        $routes->get('add', 'AppSetup\Users\UserController::addUser');
        $routes->get('(:any)', 'AppSetup\Users\UserController::getUserByNik/$1');
        $routes->post('save', 'AppSetup\Users\UserController::saveUser');
        $routes->post('table', 'AppSetup\Users\UserController::loadTable');
        $routes->get('show/(:any)', 'AppSetup\Users\UserController::showData/$1');
    });
});
