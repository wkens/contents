<?php

namespace App\Libraries;

abstract class Object{
    private $data = array();
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
        return null;
    }

    public function toArray(){
        return $this->data;
    }
    
    public function setArray($data){
        $this->data = $data;
    }
    
}

class Common {
    
}
