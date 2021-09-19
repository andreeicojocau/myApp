<?php

namespace Controllers;

class TestController extends Controller
{
  public function test($id, $id1)
  {
    return $this->render('index', ['id' => $id]);
  }
}