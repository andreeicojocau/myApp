<?php

namespace Controllers\Auth;

use Models\User;
use Helpers\AuthHelper;
use Controllers\Controller;

class AuthController extends Controller
{
  use AuthHelper;

  public function login()
  {
    if (auth()->isAuthenticated()) {
      $this->redirect('index');
    }

    if ($this->request->getMethod() == 'POST') {
      $data = $this->request->getParsedBody();

      if (auth()->authenticate($data['email'], $data['password'])) {
        $this->redirect('index');
      } else {
        $this->redirect('login');
      }
    }

    $this->setLayout('layout/auth/layout.php');

    return $this->render('auth/login');
  }

  public function register()
  {
    if (auth()->isAuthenticated()) {
      $this->redirect('index');
    }

    if ($this->request->getMethod() == 'POST') {
      $data = $this->request->getParsedBody();

      $this->validateRegister($data);

      $user = new User();
      $user->email = $data['email'];
      $user->name = $data['name'];
      $user->password = $this->encryptPassword($data['password']);
      $user->save();

      auth()->logIn($user);

      $this->redirect('index');
    }

    $this->setLayout('layout/auth/layout.php');

    return $this->render('auth/register');
  }

  public function validateRegister($data)
  {
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $this->setError('register', 'Invalid email');

      $this->redirect('register');
    }

    if (strlen($data['password']) < 6) {
      $this->setError('register', 'Password must be at least 6 characters long');

      $this->redirect('register');
    }

    if ($data['password'] != $data['confirmed_password']) {
      $this->setError('register', 'Password must be at least 6 characters long');

      $this->redirect('register');
    }

    if ($data['name'] == '' || !filter_var($data['name'], FILTER_SANITIZE_STRING)) {
      $this->setError('register', 'Invalid name');

      $this->redirect('register');
    }

    if (User::where('email', $data['email'])->first()) {
      $this->setError('register', 'There is already a record with this email in the database');

      $this->redirect('register');
    }
  }

  public function logout()
  {
    auth()->logout();

    $this->redirect('login');
  }
}
