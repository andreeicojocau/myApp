<?php

namespace Session;

use Exception\SessionException;

class Session
{
  /**
   * Initiator for session
   */
  public function __construct()
  {
    if (PHP_SESSION_ACTIVE !== session_status()) {
      if (!session_start()) {
        throw new SessionException('Failed to start the session.');
      }
    }
  }


  /**
   * Writes data to session for the given key
   * 
   * @param string $key
   * @param mixed $val
   */
  public function set(string $key, mixed $val)
  {
    $_SESSION[$key] = $val;
  }

  /**
   * Get's the data from the key
   * 
   * @param string $key
   * @return mixed
   */
  public function get(string $key): mixed
  {
    return $_SESSION[$key];
  }

  /**
   * Checks given key in session
   * 
   * @param string $key
   * @return mixed
   */
  public function has(string $key): mixed
  {
    return isset($_SESSION[$key]);
  }

  /**
   * @param string $key
   * @param string $child
   */
  public function delete($key, $child = NULL)
  {
    if ($child) {
      unset($_SESSION[$key][$child]);
    } else {
      unset($_SESSION[$key]);
    }
  }

  /**
   * Get's the session data
   * 
   * @return $_SESSION
   */
  public function getAll()
  {
    return $_SESSION;
  }

  public function getAndRemoveWithChild(string $key, string $child)
  {
    if (!$key && !$child) {
      return '';
    }

    if (isset($_SESSION[$key]) && isset($_SESSION[$key][$child])) {
      $ret = $_SESSION[$key][$child];
      // unset($_SESSION[$key][$child]);
      
      return $ret;
    }

    return '';
  }
}
