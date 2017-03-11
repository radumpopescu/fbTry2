<?php

abstract class Model
{

    public function __construct($id = null)
    {
        if (!is_null($id)){
            $this->load($id);
        }
    }

    protected abstract function load($id);
    public abstract function save();
}