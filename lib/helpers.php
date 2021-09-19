<?php

if (!function_exists('app')) {
  function app()
  {
    return Application::getInstance();
  }
}

if (!function_exists('genUrl')) {
  function genUrl($name, $params = [])
  {
    return router()->generateUri($name, $params);
  }
}

if (!function_exists('session')) {
  function session()
  {
    return app()->getSession();
  }
}

if (!function_exists('auth')) {
  function auth()
  {
    return app()->getAuth();
  }
}

if (!function_exists('router')) {
  function router()
  {
    return app()->getRouter();
  }
}
