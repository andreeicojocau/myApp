<?php

namespace Routing;

use InvalidArgumentException;

class Route
{
  /**
   * @var string
   */
  private $name;

  /**
   * @var string
   */
  private $path;
  
  /**
   * @var string
   */
  private $class;

  /**
   * @var string
   */
  private $action;

  /**
   * @var array<string>
   */
  private $methods = [];

  /**
   * @var array<string>
   */
  private $vars = [];

  /**
   * Constrructor
   * @param string $name
   * @param string $path
   * @param string $class
   * @param string $action
   * @param array $methods
   */
  public function __construct(string $name, string $path, string $class, string $action,  array $methods)
  {
    if ($methods === []) {
      throw new InvalidArgumentException('HTTP methods argument was empty; must contain at least one method');
    }

    $this->name = $name;
    $this->path = $path;
    $this->class = $class;
    $this->action = $action;
    $this->methods = $methods;
  }

  public function match(string $path, string $method): bool
  {
    $regex = $this->getPath();

    foreach ($this->getVarsNames() as $variable) {
      $varName = trim($variable, '{\}');
      $regex = str_replace($variable, '(?P<' . $varName . '>[^/]++)', $regex);
    }

    if (in_array($method, $this->getMethods()) && preg_match('#^' . $regex . '$#sD', self::trimPath($path), $matches)) {
      $values = array_filter($matches, static function ($key) {
        return is_string($key);
      }, ARRAY_FILTER_USE_KEY);

      foreach ($values as $key => $value) {
        $this->vars[$key] = $value;
      }

      return true;
    }

    return false;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getPath(): string
  {
    return $this->path;
  }

  public function getClass(): string
  {
    return $this->class;
  }

  public function getAction(): string
  {
    return $this->action;
  }

  public function getMethods(): array
  {
    return $this->methods;
  }

  public function getVarsNames(): array
  {
    preg_match_all('/{[^}]*}/', $this->path, $matches);

    return reset($matches) ?? [];
  }

  public function hasVars(): bool
  {
    return $this->getVarsNames() !== [];
  }

  public function getVars(): array
  {
    return $this->vars;
  }

  public static function trimPath(string $path): string
  {
    return '/' . rtrim(ltrim(trim($path), '/'), '/');
  }
}
