<?php

abstract class Model
{
    public function __construct($id = null, $data = [])
    {
        if (!is_null($id)){
            $this->load($id, $data);
        }
    }

    protected function checkValidData($data){
        $requiredFields = $this->getRequiredFields();
        foreach ($requiredFields as $f){
            if (!array_key_exists($f, $data)){
                return false;
            }
        }
        return true;
    }

    protected abstract function load($id, $data);
    protected abstract function getRequiredFields();
    public abstract function toArray();
    public abstract function save();
}