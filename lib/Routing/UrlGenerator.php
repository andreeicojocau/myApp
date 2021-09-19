<?php

namespace Routing;

use Exception\InvalidArgumentException;

class UrlGenerator
{
  /**
   * @var \ArrayAccess<Route>
   */
  private $routes;

  /** Constructor */
  public function __construct(\ArrayAccess $routes)
  {
    $this->routes = $routes;
  }

  /**
   * Parse route and params
   */
  public function generate(string $name, array $parameters = []): string
  {
    if ($this->routes->offsetExists($name) === false) {
      throw new InvalidArgumentException('Unknown ' . $name . ' name route');
    }

    $route = $this->routes[$name];
    if ($route->hasVars() && $parameters === []) {
      throw new InvalidArgumentException($name . ' route need parameters: ' . implode(',', $route->getVarsNames()));
    }

    return self::resolveUri($route, $parameters);
  }

  private static function resolveUri(Route $route, array $parameters): string
  {
    $uri = $route->getPath();

    foreach ($route->getVarsNames() as $variable) {
      $varName = trim($variable, '{\}');
      if (array_key_exists($varName, $parameters) === false) {
        throw new \InvalidArgumentException(
          sprintf('%s not found in parameters to generate url', $varName)
        );
      }

      $uri = str_replace($variable, $parameters[$varName], $uri);
    }

    return $uri;
  }
}
