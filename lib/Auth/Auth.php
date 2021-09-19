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
   * Function that logs in the user object
   * 
   * @param User $user
   */
  public function logIn(User $user)
  {
    if ($user) {
      $this->setUser($user);
    }
  }

  /**
   * @param  mixed $user
   * @return void
   */
  private function setUser(User $user)
  {
    $this->session->set('user', $user->id);

    $this->user = $user;
  }

  /**
   * Checker to see if the user is logged in
   * 
   * @return bool
   */
  public function isAuthenticated()
  {
    return $this->session->get('user') ? true : false;
  }

  /**
   * Getter for logged in user
   * 
   * @return mixed
   */
  public function getUser()
  {
    if ($this->session->get('user')) {
      return User::find($this->session->get('user'));
    }

    return null;
  }

  /**
   * Logout user and remove session
   */
  public function logout()
  {
    $this->session->delete('user');
  }
}