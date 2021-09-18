<?php

namespace Database;

/*
* Mysql database class - only one connection alowed
*/
class MysqlConnection
{
  private $connectiton;
  private static $instance;
  private $_host = "HOSTt";
  private $_username = "USERNAME";
  private $_password = "PASSWORd";
  private $_database = "DATABASE";

  /**
   * Init function to create hte instance
   */
  public static function getInstance(): self
  {
    if (!self::$instance) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  /** Private constructor */
  private function __construct()
  {
    $this->connectiton = new mysqli(
      $this->_host,
      $this->_username,
      $this->_password,
      $this->_database
    );

    if (mysqli_connect_error()) {
      throw new Exception('Failed to conencto to MySQL: ' . mysql_connect_error());
    }
  }

  /**
   * Throw exception if clone is called to prevent duplicating connection
   */
  private function __clone()
  {
    throw new Exception('Only one instace of mysql should be running');
  }

  /**
   * Getter for the connection
   * 
   */
  public function getConnection()
  {
    return $this->connectiton;
  }
}
