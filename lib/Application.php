<?php

use Routing\Router;
use Helpers\PathHelper;
use GuzzleHttp\Psr7\ServerRequest;

class Application
{
  use PathHelper;
  public Router $router;
  private $routesFile = 'routes.php';

  public function __construct()
  {
    $this->router = require($this->getConfigPath() . $this->routesFile);
  }

  public function run()
  {
    $request  = ServerRequest::fromGlobals();
    $route    = $this->router->match($request);
    
    $controllerName = $route->getClass();
    $controller = new $controllerName($request);
    
    try {
      if (!is_callable($controller)) {
        $controller = [$controller, $route->getAction()];
      }

      return $controller(...array_values($route->getVars()));
    } catch (Exception $e) {
      header("HTTP/1.0 404 Not Found");
    }
  }
}