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
        $posts = Post::getAll();

        echo $this->twig->render('index.html.twig', [
            'users' => User::getAll(),
            'posts' => $posts
        ]);
    }

    public function postAction()
    {
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