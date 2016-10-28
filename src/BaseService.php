<?php

namespace ExtService;

use app\ExtService\BaseGetter;
use app\ExtService\BaseSetter;
use ExtService\Interfaces\Request;
use ExtService\Interfaces\Response;
use ExtService\Interfaces\Service;

class BaseService implements Service
{
    use BaseSetter, BaseGetter;

    protected static $instance;
    protected $_params = [];

    public static function getInstance()
    {
        if (null === self::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function query(Request $request, Response $response)
    {
        // TODO: Implement query() method.
    }
}