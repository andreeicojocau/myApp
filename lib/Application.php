<?php

use Auth\Auth;
use Routing\Router;
use Session\Session;
use Helpers\PathHelper;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
  use PathHelper;
  private Auth $auth;
  private Router $router;
  private Capsule $database;
  private Session $session;
  private static $instance;

  /**
   * Private constructor
   */
  private function __construct()
  {
    /** Should load db only when needed .. */
    $this->database = require($this->getConfigPath() . 'database.php');
    $this->router   = require($this->getConfigPath() . 'routes.php');
    $this->session  = new Session();
    $this->auth     = new Auth($this->session);
  }

  /**
   * Init function to create the instance
   */
  public static function getInstance(): self
  {
    if (!self::$instance) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  /** Actual application starter */
  public function run()
  {
    $this->loadMigrations();

    $this->router->init();
  }

  /** Getters for services */
  public function getRouter(): Router
  {
    return $this->router;
  }

  public function getAuth(): Auth
  {
    return $this->auth;
  }

  public function getSession(): Session
  {
    return $this->session;
  }

  /**
   * Migrate all migrations every time
   * Needs furhter implementation 
   * 1. make a migrations table
   * 2. make script to run in console
   */
  public function loadMigrations()
  {
    $dir = scandir($this->getDatabasePath());
    
    foreach($dir as $migration) {
      if($migration == '.' || $migration == '..') continue;

      require $this->getDatabasePath() . $migration;
    }
  }
}
