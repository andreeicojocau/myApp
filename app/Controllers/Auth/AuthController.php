<?php

namespace Controllers\Auth;

use Controllers\Controller;

class AuthController extends Controller
{
  public function login()
  {
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
    if ($this->request->getMethod() == 'POST') {
      $data = $this->request->getParsedBody();
      dd($data);
      // if (auth()->authenticate($data['email'], $data['password'])) {
      //   $this->redirect('index');
      // } else {
      //   $this->redirect('login');
      // }
    }

    $this->setLayout('layout/auth/layout.php');

    return $this->render('auth/register');
  }
}
