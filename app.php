<?php
require "vendor/autoload.php";
require "config.php";
require "model/Model.php";
require "model/User.php";

try{
    new \Pixie\Connection('mysql', $dbConfig, 'QB');
}
catch(Exception $e){}


$u = new User(1);
$u->setName("Will Smith");
$u->save();
echo $u;
