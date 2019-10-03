<?php

namespace ExtService\Traits;

/**
 * Trait BaseSetter.
 *
 * @package ExtService\Traits
 */
trait BaseSetter
{
    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        foreach ($params as $var => $val) {
            $this->_params[$var] = $val;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function setParam($name, $value)
    {
        $this->_params[$name] = $value;
    }
}
