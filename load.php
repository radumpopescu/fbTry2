<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "vendor/autoload.php";
require "model/Model.php";
require "model/User.php";
require "model/Post.php";

$dbConfig = array(
    'driver'    => 'mysql', // Db driver
    'host'      => 'db',
    'database'  => 'interview',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8', // Optional
    'collation' => 'utf8_unicode_ci', // Optional
    'prefix'    => '', // Table prefix, optional
);


try{
    new \Pixie\Connection('mysql', $dbConfig, 'QB');
}
catch(Exception $e){}


$loader = new Twig_Loader_Filesystem('./views');
$twig = new Twig_Environment($loader, array(
//    'cache' => './cache',
));
