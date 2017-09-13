<?php

/**
 * Class User
 */
class User {

    private $_name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }


}


$user = new User();


$user->setName('saki');

echo $user->name;


