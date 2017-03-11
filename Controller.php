<?php

class Controller
{
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
        $page = null;

        if (isset($_GET['page']) && method_exists($this, $action = $_GET['page'] . "Action")){
            $this->$action();
        }
        else{
            $this->defaultAction();
        }
    }

    public function defaultAction()
    {
        $user = null;
        if (isset($_COOKIE['user'])){
            $user = new User($_COOKIE['user']);
        }
        echo $this->twig->render('index.html.twig', [
            'currentUser' => $user,
            'users' => User::getAll(),
            'posts' => Post::getAll()
        ]);
    }

    public function postAction()
    {
        if (!isset($_POST["content"])){
            die("No content defined");
        }
        if (!isset($_COOKIE["user"])){
            die("User not logged in");
        }
        $post = new Post();
        $post->setContent($_POST['content'])->setUser($_COOKIE['user'])->save();
        echo json_encode($post->toArray());
//        $twig->render('index.html.twig', $post->toArray());
    }

    public function getUsersAction()
    {
        $users = [];
        if (isset($_GET['group'])){
            $users = User::getAllByGroup($_GET['group']);
        }
        else{
            $users = User::getAll();
        }

        echo $this->getJsonResponse($users);
    }


    function getJsonResponse($objects){
        $arr = [];
        foreach ($objects as $obj){
            $arr[] = $obj->toArray();
        }

        return json_encode($arr);
    }
}