<?php

class Post extends Model
{

    private $id;
    private $content;
    private $user;
    private $added;

    protected function load($id, $data)
    {
        if (!$this->checkValidData($data)){
            $data = QB::table('post')->find($id);
        }

        $this->id       = $id;
        $this->content  = $data['content'];
        $this->user     = $data['user'];
        $this->added    = $data['added'];
    }

    protected function getRequiredFields()
    {
        return [
            'content',
            'user',
            'added'
        ];
    }


    public static function getAll()
    {
        $rows = QB::table('post')->findAll;
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
    public function getAdded()
    {
        return $this->added;
    }

    function __toString()
    {
        return json_encode([
            "id"    =>  $this->id,
            "content"  =>  $this->content,
            "user" =>  $this->user,
            "added" =>  $this->added
        ]);
    }


    public function save()
    {
        $data = array(
            'name'  => $this->name,
            'group' => $this->group
        );

        if (is_null($this->id)){
            $this->id = QB::table('user')->insert($data);
        }else{
            QB::table('user')->where('id', $this->id)->update($data);

        }
    }


}