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
        $user = $this->getLoggedUser();

        $data = [
            'currentUser' => $user,
            'users' => User::getAll(),
        ];
        if ($user){
            $data['posts'] = PostFactory::getAllByGroup($user->getGroup());
        }

        echo $this->twig->render('index.html.twig', $data);
    }

    public function searchAction()
    {
        $user = $this->getLoggedUser();
        $posts = [];
        $user = new User(1);
        if (isset($_GET['search'])){
            $posts = PostFactory::filterAllByGroup($user->getGroup(), $_GET['search']);
//            echo $this->getJsonResponse($posts);
        }else{
            $posts = PostFactory::getAllByGroup($user->getGroup());
        }
        echo $this->twig->render('posts.html.twig', [
            "posts" => $posts,
            "search" => isset($_GET['search']) ? $_GET['search'] : ""
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


    private function getJsonResponse($objects){
        $arr = [];
        foreach ($objects as $obj){
            $arr[] = $obj->toArray();
        }

        return json_encode($arr);
    }

    /**
     * @return null|User
     */
    private function getLoggedUser()
    {
        $user = null;
        if (isset($_COOKIE['user'])) {
            $user = new User($_COOKIE['user']);
            return $user;
        }
        return $user;
    }


}