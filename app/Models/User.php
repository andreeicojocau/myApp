<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  /**
   * Fields for update
   */
  protected $fillable = ['name', 'email'];

  /**
   * Fields hidden from arrays
   */
  protected $hidden = ['password'];
}