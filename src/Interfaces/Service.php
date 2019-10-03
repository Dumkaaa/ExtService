<?php

namespace ExtService\Interfaces;

interface Service
{
    public function setParams(array $params);

    public function getParams();

    public function setParam($name, $value);

    public function getParam($name);

    public function query(Request $request, Response $response);
}
