<?php

namespace ExtService\Interfaces;

interface Response
{
    //public function __construct(array $params = null);

    public function getData();

    public function getError();

    public function getStatus();

    public function getCookies();

    public function setData($data);

    public function setError($message);

    public function setStatus($status);

    public function setCookies($cookie);
}
