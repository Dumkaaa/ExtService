<?php


namespace ExtService\Interfaces;

use ExtService\Interfaces\Request;
use ExtService\Interfaces\Response;

interface Service
{
    public function setParams(array $params);

    public function getParams();

    public function setParam($name, $value);

    public function getParam($name);

    public function query(Request $request, Response $response);

    //public function queryAll(Request $request, ResponseList $response);
}