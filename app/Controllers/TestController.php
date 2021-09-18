<?php

namespace Controllers;

class TestController extends Controller
{
  public function test($id, $id1)
  {
    $this->render('index', ['id' => $id]);
  }
}