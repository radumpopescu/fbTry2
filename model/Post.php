<?php

class Post extends Model
{

    private $id;
    private $content;
    private $user;
    private $added;

    protected function load($id, $data = [])
    {
        if (!$this->checkValidData($data)){
            $data = QB::table('post')->find($id);
        }

        $this->id       = $id;
        $this->content  = $data->content;
        $this->user     = $data->user;
        $this->added    = $data->added;
    }

    protected function getRequiredFields()
    {
        return [
            'content',
            'user',
            'added'
        ];
    }

    public static function getAllByGroup($groupId)
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

    public function toArray()
    {
        return [
            "id"        =>  $this->id,
            "content"   =>  $this->content,
            "user"      =>  $this->user,
            "added"     =>  $this->added
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