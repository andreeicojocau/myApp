<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
   "driver"   => "mysql",
   "host"     => 'db',
   "database" => "app",
   "username" => "root",
   "password" => "123456"
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

return $capsule;