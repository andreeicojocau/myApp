<?php

namespace Controllers;

class HomeController extends Controller
{
  public function index()
  {
    $this->redirect('login');
  }
}