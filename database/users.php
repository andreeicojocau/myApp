<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$schema = Capsule::schema();

if (!$schema->hasTable('users')) {
  $schema->create('users', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->timestamps();
  });
}
