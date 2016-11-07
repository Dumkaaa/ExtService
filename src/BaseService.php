<?php

namespace ExtService;

use ExtService\Traits\BaseGetter;
use ExtService\Traits\BaseSetter;
use ExtService\BaseRequest;
use ExtService\BaseResponse;
use ExtService\Interfaces\Service as IService;

class BaseService implements IService
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

    public function query(BaseRequest $request, BaseResponse $response)
    {
        $request->query(
            $request->getMethod(),
            $request->getUrl(),
            $request->getBody()
        );

        $response->setData($request->getResult());
        $response->setCookies($request->getCookies());
        $response->setStatus($request->getStatus());

        return $response;
    }
}