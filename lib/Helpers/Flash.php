<?php

namespace Helpers;

/** 
 * Simple helper class for flash messages 
 */
trait Flash
{  
  /**
   * statuses
   *
   * @var array
   */
  public $statuses = [
    0 => 'error',
    1 => 'success'
  ];
  
  /**
   * @param  string $key
   * @param  string $message
   * @param  string $status
   * @return void
   */
  public function set(string $key, string $message, string $status)
  {
    if (in_array($status, $this->statuses)) {
      session()->set($status, $this->getMessageArray($key, $message));
    }
  }
  
  /**
   * @param  mixed $key
   * @param  mixed $message
   * @return void
   */
  public function setSuccess(string $key, string $message)
  {
    session()->set($this->statuses[1], $this->getMessageArray($key, $message));
  }
  
  /**
   * @param  mixed $key
   * @param  mixed $message
   * @return void
   */
  public function setError(string $key, string $message)
  {
    session()->set($this->statuses[0], $this->getMessageArray($key, $message));
  }
  
  /**
   * Helper function to generate array keys for session
   *
   * @param  string $key
   * @param  mixed $message
   * @return array
   */
  public function getMessageArray(string $key, string $message): array
  {
    return [$key => $message];
  }
  
  /**
   * @param  mixed $status
   * @return mixed
   */
  public function getErrors(): mixed
  {
    return session()->get($this->statuses[0]);
  }

  /**
   * @param  mixed $status
   * @return bool
   */
  public function hasErrors(): bool
  {
    return session()->has($this->statuses[0]);
  }

  /**
   * @param string $key
   * @return string
   */
  public function getError(string $key)
  {
    return $this->getAndRemoveMessage($this->statuses[0], $key);
  }

  /**
   * @param string $key
   * @return string
   */
  public function getSuccess(string $key)
  {
    return $this->getAndRemoveMessage($this->statuses[1], $key);
  }

  /**
   * @param string $key
   */
  public function getAndRemoveMessage($key, $child)
  {
    return session()->getAndRemoveWithChild($key, $child);
  }
}
