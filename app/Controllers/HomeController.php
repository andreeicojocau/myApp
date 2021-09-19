<?php

namespace Controllers;

class HomeController extends Controller
{
  public function index()
  {
    $this->setActiveMenu('dashboard');

    if (auth()->isAuthenticated()) {
      return $this->render('dashboard/dashboard');
    }

    $this->redirect('login');
  }
}
