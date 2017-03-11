<?php
require "load.php";


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

//$p = new Post(1,[
//    "content"=>"WW",
//    "user" => 1,
//    "added"=>"2313"
//]);
//echo $p;
