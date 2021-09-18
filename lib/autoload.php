<?php

/*
 * Simple autoloader to get the classes from lib dir
 */

spl_autoload_register(function ($className) {
  $dirs = ['app', 'lib'];

  foreach($dirs as $dir) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, (dirname(__DIR__) . '\\' . $dir . '\\' . $className . '.php'));

    if (file_exists($file)) {
      include $file;
    }
  }
});
