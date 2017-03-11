<?php

class User extends Model
{
    private $id;
    private $name;
    private $group;

    protected function load($id, $data)
    {
        if (!$this->checkValidData($data)){
            $data = QB::table('user')->find($id);
        }

        $this->id       = $id;
        $this->name     = $data['name'];
        $this->group    = $data['group'];
    }

    protected function getRequiredFields()
    {
        return [
            'name',
            'group'
        ];
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

    function __toString()
    {
        return json_encode([
            "id"=>$this->id,
            "name"=>$this->name,
            "group"=>$this->group
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