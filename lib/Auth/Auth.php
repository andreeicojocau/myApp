<?php

namespace Auth;

use Helpers\AuthHelper;
use Helpers\Flash;
use Models\User;
use Session\Session;

class Auth
{
  use AuthHelper, Flash;

  /**
   * Logged in user
   */
  private User $user;

  /**
   * Session storage
   */
  private Session $session;
  
  /**
   * Constructor
   *
   * @param  Session $session
   */
  public function __construct(Session $session)
  {
    $this->session = $session;
  }

  /**
   * Authenticates user
   * 
   * @param string $email
   * @param string $password
   * 
   */
  public function authenticate($email, $password)
  {
    $user = User::where('email', $email)->first();

    if (empty($user)) {
      $this->setError('user_not_found', 'User not found with email' . $email);

      return false;
    }

    if (!$this->passwordCheck($password, $user->password)) {
      $this->setError('wrong_password', 'Email or password invalid');

      return false;
    }

    $this->setUser($user);

    return true;
  }
  
  /**
   * setUser
   *
   * @param  mixed $user
   * @return void
   */
  private function setUser(User $user)
  {
    //set session
  }

  public function isAuthenticated()
  {

  }

  public function getUser()
  {
    return $this->user;
  }
}