<?php

namespace Models;

use Database\MysqlConnection;

abstract class Model
{
  public MysqlConnection $connection;
  /**
   * Constructor
   */
  public function __construct()
  {
    $this->connection = MysqlConnection::getInstance();
  }
}