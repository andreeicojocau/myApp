<?php

namespace Helpers;

trait AuthHelper 
{
  public function passwordCheck($plainPassword, $encryptedPassword)
  {
    return password_verify($plainPassword, $encryptedPassword);
  }

  public function encryptPassword($plainPassword)
  {
    return password_hash($plainPassword, PASSWORD_DEFAULT);
  }
}