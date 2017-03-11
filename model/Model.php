<?php

/**
 * Class Model
 *
 * Model abstract
 */
abstract class Model
{
    /**
     * Model constructor.
     * @param null $id Empty if creating a new object
     * @param array $data Data that constructs the object or empty in order to get it from DB
     */
    public function __construct($id = null, $data = [])
    {
        if (!is_null($id)) {
            $this->load($id, $data);
        }
    }

    /**
     * Checks if data is valid for the current object
     * @param $data
     * @return bool
     */
    protected function checkValidData($data)
    {
        $requiredFields = $this->getRequiredFields();
        foreach ($requiredFields as $f) {
            if (!array_key_exists($f, $data)) {
                return false;
            }
        }
        return true;
    }

    protected abstract function load($id, $data);

    /**
     * Required fields for a full instantiation of the current object
     * @return mixed
     */
    protected abstract function getRequiredFields();

    public abstract function toArray();

    /**
     * Persist to DB
     * If the id is not set on the object, then a new entry will be created in DB
     * @return mixed
     */
    public abstract function save();
}
