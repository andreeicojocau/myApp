<?php

namespace Routing;

use ArrayIterator;
use Exception;
use Helpers\PathHelper;
use GuzzleHttp\Psr7\ServerRequest;
use Exception\MethodNotFoundException;

/** Handler class for application routes */
class Router
{
  use PathHelper;

  private static $instance;

  private ArrayIterator $routes;

  private UrlGenerator $urlGenerator;

  /** Constructor */
  public function __construct()
  {
    $this->routes = new ArrayIterator();
  }

  public function addRoute($name, $url, $class, $action, $method = ['GET'])
  {
    $route = new Route($name, $url, $class, $action, $method);

    $this->routes->offsetSet($route->getName(), $route);
  }

  public function match(ServerRequest $serverRequest): Route
  {
    return $this->matchFromPath($serverRequest->getUri()->getPath(), $serverRequest->getMethod());
  }

  public function matchFromPath(string $path, string $method): Route
  {
    foreach ($this->routes as $route) {
      if ($route->match($path, $method) === false) {
        continue;
      }

      return $route;
    }

    throw new MethodNotFoundException('No route found for ' . $method, 404);
  }

  public function generateUri(string $name, array $parameters = []): string
  {
    return $this->urlGenerator->generate($name, $parameters);
  }

  public function getUrlgenerator(): UrlGenerator
  {
    return $this->urlGenerator;
  }

  public function redirectTo(string $routeName, $params)
  {
    $uri = $this->generateUri($routeName, $params);

    header("Location: $uri");
  }

  public function init()
  {
    $this->urlGenerator = new UrlGenerator($this->routes);
    $request  = ServerRequest::fromGlobals();
    $route    = $this->match($request);

    $controllerName = $route->getClass();
    $controller = new $controllerName($request);
    
    if (!is_callable($controller)) {
      $controller = [$controller, $route->getAction()];
    }

    echo $controller(...array_values($route->getVars()));
  }
}
