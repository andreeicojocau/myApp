<?php

namespace Routing;

use ArrayIterator;
use Exception;
use Helpers\PathHelper;
use Exception\MethodNotFoundException;
use GuzzleHttp\Psr7\ServerRequest;

/** Handler class for application routes */
class Router
{
  use PathHelper;

  private ArrayIterator $routes;
  private static $instance;

  /** Constructor */
  public function __construct()
  {
    $this->routes = new ArrayIterator();
  }

  public function addRoute($name, $url, $class, $action, $method = ['GET'])
  {
    $this->routes->append(new Route($name, $url, $class, $action, $method));
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

    throw new \Exception('No route found for ' . $method, 404);
  }

  public function generateUri(string $name, array $parameters = []): string
  {
    return $this->urlGenerator->generate($name, $parameters);
  }

  public function getUrlgenerator(): UrlGenerator
  {
    return $this->urlGenerator;
  }
}
