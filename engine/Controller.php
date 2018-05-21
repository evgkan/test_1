<?php

namespace engine;

abstract class Controller
{

    private $GetParams = [];


    public function __construct(array $GetParams)
    {
        foreach ($GetParams as $name => $val) {
            $this->GetParams[$name] = $val;
        }
    }


    protected function getParam($name)
    {
        if(!isset($this->GetParams[$name]))
            throw new \Exception("GET param '$name' is not found");
        return $this->GetParams[$name];
    }

}