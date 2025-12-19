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


$routes->group(
    '',
    ['filter' => ['auth', 'ratelimit:100,60']],
    static function ($routes) {

        // Dashboard page
        // $routes->routes->get('/dashboard', 'Dashboard\DashboardController::index');
    }
);
