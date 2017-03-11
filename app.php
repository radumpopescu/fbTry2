<?php
require "vendor/autoload.php";
require "config.php";
require "model/Model.php";
require "model/User.php";
require "model/Post.php";


echo $twig->render('index.html.twig', array('name' => 'Fabien'));


//$loader = new Twig_Loader_Array(array(
//    'index' => 'Hello {{ name }}!',
//));
//$twig = new Twig_Environment($loader);
//
//echo $twig->render('index', array('name' => 'Fabien'));

//var_dump("A");
//$u = new User(1);
//$u->setName("Will Smith");
//$u->save();
//echo $u;

//$p = new Post(1);
//echo $p;
