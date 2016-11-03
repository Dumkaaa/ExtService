<?php


namespace ExtService\Interfaces;

use ExtService\BaseRequest;
use ExtService\BaseResponse;

interface Service
{
    public function setParams(array $params);

    public function getParams();

    public function setParam($name, $value);

    public function getParam($name);

    public function query(BaseRequest $request, BaseResponse $response);

    //public function queryAll(Request $request, ResponseList $response);
}