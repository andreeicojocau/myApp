<?php
/**
 * List of all the app's routes
 */

use Controllers\Auth\AuthController;
use Routing\Router;
use Controllers\HomeController;

$router = new Router();

$router->addRoute('index', '/', HomeController::class, 'index');
$router->addRoute('login', '/login', AuthController::class, 'login', ['GET', 'POST']);
$router->addRoute('register', '/register', AuthController::class, 'register', ['GET', 'POST']);

return $router;