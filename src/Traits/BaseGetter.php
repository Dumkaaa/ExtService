<?php

namespace app\ExtService;

trait BaseGetter
{
    protected function getParams()
    {
        return $this->_params;
    }

    protected function getParam($name)
    {
        return $this->_params[$name];
    }

}