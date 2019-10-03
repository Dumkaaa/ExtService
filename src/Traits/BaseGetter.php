<?php

namespace ExtService\Traits;

/**
 * Trait BaseGetter.
 *
 * @package ExtService\Traits
 */
trait BaseGetter
{
    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * @param      $name
     * @param null $default
     *
     * @return mixed|null
     */
    public function getParam($name, $default = null)
    {
        return array_key_exists($name, $this->_params)
            ? $this->_params[$name]
            : $default;
    }
}
