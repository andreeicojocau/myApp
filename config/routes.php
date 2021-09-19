<?php
/**
 * List of all the app's routes
 */

use Controllers\Auth\AuthController;
use Routing\Router;
use Controllers\HomeController;
use Controllers\Users\UserController;

$router = new Router();

/** Auth routes */
$router->addRoute('login', '/login', AuthController::class, 'login', ['GET', 'POST']);
$router->addRoute('logout', '/logout', AuthController::class, 'logout', ['GET', 'POST']);
$router->addRoute('register', '/register', AuthController::class, 'register', ['GET', 'POST']);

/** Logged in or not */
$router->addRoute('index', '/', HomeController::class, 'index');

$router->addRoute('users', '/users', UserController::class, 'index');
$router->addRoute('users.store', '/users/store', UserController::class, 'store', ['GET', 'POST']);
$router->addRoute('users.update', '/users/update/{id}', UserController::class, 'update', ['GET', 'POST']);
$router->addRoute('users.delete', '/users/delete/{id}', UserController::class, 'delete');

return $router;