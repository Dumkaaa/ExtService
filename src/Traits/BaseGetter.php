<?php

namespace ExtService\Traits;

trait BaseGetter
{
    public function getParams()
    {
        return $this->_params;
    }

    public function getParam($name)
    {
        return $this->_params[$name];
    }

}