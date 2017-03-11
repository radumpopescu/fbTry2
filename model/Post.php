<?php

class Post extends Model
{

    private $id;
    private $content;
    private $user;
    private $created;

    protected function load($id, $data = [])
    {
        if (!$this->checkValidData($data)){
            $data = QB::table('post')->find($id);
        }

        $this->id       = $id;
        $this->content  = $data->content;
        $this->user     = new User($data->user);
        $this->created  = $data->created;
    }

    protected function getRequiredFields()
    {
        return [
            'content',
            'user',
            'created'
        ];
    }

    public static function getAll()
    {
        $posts = [];
        $query = QB::table('post')
            ->join('user', 'user.id', '=', 'post.user')
            ->orderBy('created', 'DESC')
            ->select(["post.*", "user.name"]);
        $results = $query->get();
        var_dump($results);die;
        foreach ($results as $r){
            $posts[] = new self($r->id, $r);
        }
        return $posts;
    }

    public static function getAllByGroup($group)
    {
        $posts = [];
        $query = QB::table('post')
            ->join('user', 'user.id', '=', 'post.user')
            ->where('user.group', '=', $group)
            ->orderBy('created', 'DESC')
            ->select(["post.*", "user.name"]);
        $results = $query->get();
        foreach ($results as $r){
            $posts[] = new self($r->id, $r);
        }
        return $posts;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Post
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    public function toArray()
    {
        return [
            "id"        =>  $this->id,
            "content"   =>  $this->content,
            "user"      =>  $this->user,
            "created"     =>  $this->created
        ];
    }

    function __toString()
    {
        return json_encode($this->toArray());
    }


    public function save()
    {
        $data = [
            "content"   =>  $this->content,
            "user"      =>  $this->user
        ];

        if (is_null($this->id)){
            $this->id = QB::table('post')->insert($data);
            $this->load($this->id);
        }else{
            QB::table('post')->where('id', $this->id)->update($data);

        }
    }


}