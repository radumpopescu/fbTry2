<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "vendor/autoload.php";
require "model/Model.php";
require "model/User.php";
require "model/Post.php";
require "model/UserFactory.php";
require "model/PostFactory.php";
require "Controller.php";

$dbConfig = array(
    'driver' => 'mysql', // Db driver
    'host' => 'db',
    'database' => 'interview',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8', // Optional
    'collation' => 'utf8_unicode_ci', // Optional
    'prefix' => '', // Table prefix, optional
);


try {
    new \Pixie\Connection('mysql', $dbConfig, 'QB');
} catch (Exception $e) {
}

$filter = new Twig_SimpleFilter('timeago', function ($datetime) {

    $time = time() + 1 - strtotime($datetime);

    $units = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($units as $unit => $val) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return ($val == 'second') ? 'a few seconds ago' :
            (($numberOfUnits > 1) ? $numberOfUnits : 'a')
            . ' ' . $val . (($numberOfUnits > 1) ? 's' : '') . ' ago';
    }

});

$loader = new Twig_Loader_Filesystem('./views');
$twig = new Twig_Environment($loader, array(//    'cache' => './cache',
));
$twig->addFilter($filter);


