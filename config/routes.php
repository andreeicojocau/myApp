<?php
/**
 * List of all the app's routes
 */

use Routing\Router;
use Controllers\HomeController;
use Controllers\TestController;

$router = new Router();

$router->addRoute('index', '/', HomeController::class, 'index');
$router->addRoute('test', '/test/{id}/{id1}', TestController::class, 'test');

return $router;