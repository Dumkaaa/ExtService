<?php

namespace ExtService\Interfaces;

interface Request
{
    /*need*/

    public function __construct(array $params = null);

    public function setParams(array $params);

    public function setParam($name, $value);

    public function setHeaders(array $headers);



    public function setCookies(array $cookie);



    //public function setData($data);





}