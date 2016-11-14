<?php

namespace ExtService;

use ExtService\Traits\BaseGetter;
use ExtService\Traits\BaseSetter;
use ExtService\BaseRequest;
use ExtService\BaseResponse;
use ExtService\Interfaces\Service as IService;
use ExtService\Interfaces\Request as IRequest;
use ExtService\Interfaces\Response as IResponse;

class BaseService implements IService
{
    use BaseSetter, BaseGetter;

    protected $_params = [];

    public function query(IRequest $request, IResponse $response)
    {
        $request->query(
            strtoupper($request->getMethod()),
            $request->getUrl(),
            $request->getBody()
        );

        $response->setData($request->getResult());
        $response->setCookies($request->getCookies());
        $response->setStatus($request->getStatus());

        return $response;
    }
}