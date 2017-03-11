<?php
require "load.php";

$page = "";
if (isset($_GET['page'])){
    $page = $_GET['page'];
}
switch ($page){
    case "users":
        $userObjects = [];
        if (isset($_GET['group'])){
            $userObjects = User::getAllByGroup($_GET['group']);
        }
        else{
            $userObjects = User::getAll();
        }
        $users = [];
        foreach ($userObjects as $user){
            $users[] = $user->toArray();
        }
        echo json_encode($users);
        break;

    case "post":
        if (!isset($_POST["content"])){
            die("No content defined");
        }
        if (!isset($_POST["user"])){
            die("User not defined");
        }
        $post = new Post();
        $post->setContent($_POST['content'])->setUser($_POST['user'])->save();
        echo json_encode($post->toArray());
//        $twig->render('index.html.twig', $post->toArray());
        break;
    default:
        $posts = Post::getAll();
        $postsArray = [];
        foreach ($posts as $post){
            $postsArray[] = $post->toArray();
        }
        echo $twig->render('index.html.twig', array('posts' => $postsArray));
        break;
}






