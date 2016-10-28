<?php

namespace app\ExtService;

trait BaseSetter
{
    public function setParams(array $params)
    {
        foreach ($params as $var => $val) {
            $this->_params[$var] = $val;
        }
    }

    public function setParam($name, $value)
    {
        $this->_params[$name] = $value;
    }
}