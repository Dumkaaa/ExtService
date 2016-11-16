<?php


namespace ExtService\Interfaces;

interface Request
{
    public function __construct(array $params = null);


    public function setParams(array $params);

    public function setParam($name, $value);

    public function setHeaders(array $headers);

    public function setCookies(array $cookie);

    public function setAuthorization($user, $pass);


    public function getParams();

    public function getParam($name);

    public function getHeaders();

    public function getCookies();
}