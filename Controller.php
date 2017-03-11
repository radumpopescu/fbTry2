<?php

class Controller
{
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
        $page = null;

        if (isset($_GET['page']) && method_exists($this, $action = $_GET['page'] . "Action")) {
            $this->$action();
        } else {
            $this->defaultAction();
        }
    }

    /**
     * Main view
     */
    public function defaultAction()
    {
        $user = $this->getLoggedUser();

        $data = [
            'currentUser' => $user,
            'users' => UserFactory::getAll(),
        ];
        if ($user) {
            $data['posts'] = PostFactory::getAllByGroup($user->getGroup());
        }

        echo $this->twig->render('index.html.twig', $data);
    }

    /**
     * Get posts that contain a search term
     */
    public function searchAction()
    {
        $user = $this->getLoggedUser();
        $posts = [];
        $user = new User(1);
        if (isset($_GET['search'])) {
            $posts = PostFactory::filterAllByGroup($user->getGroup(), $_GET['search']);
        } else {
            $posts = PostFactory::getAllByGroup($user->getGroup());
        }
        echo $this->twig->render('posts.html.twig', [
            "posts" => $posts,
            "search" => isset($_GET['search']) ? $_GET['search'] : ""
        ]);
    }

    /**
     * Insert a new post
     */
    public function postAction()
    {
        if (!isset($_POST["content"])) {
            die("No content defined");
        }
        if (!isset($_COOKIE["user"])) {
            die("User not logged in");
        }
        $post = new Post();
        $post->setContent($_POST['content'])->setUser($_COOKIE['user'])->save();
        echo json_encode($post->toArray());
    }

    /**
     * Get a list of users
     */
    public function getUsersAction()
    {
        $users = [];
        if (isset($_GET['group'])) {
            $users = UserFactory::getAllByGroup($_GET['group']);
        } else {
            $users = UserFactory::getAll();
        }

        echo $this->getJsonResponse($users);
    }

    /**
     * Transform a list of model objects into a json string
     * @param $objects
     * @return string
     */
    private function getJsonResponse($objects)
    {
        $arr = [];
        foreach ($objects as $obj) {
            $arr[] = $obj->toArray();
        }

        return json_encode($arr);
    }

    /**
     * Gets the currently logged in user
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