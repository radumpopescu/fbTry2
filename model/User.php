<?php

class User
{
    private $id;
    private $name;
    private $group;

    public function __construct($id = null)
    {
        if (!is_null(id)){
            $this->load($id);
        }
    }

    private function load($id)
    {
        $row = QB::table('user')->find($id);
        $this->id = $row->id;
        $this->name = $row->name;
        $this->group = $row->group;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }


}