<?php

namespace ExtService\Interfaces;

interface Request
{
    /*need*/

    public function __construct(array $params = null);

    public function setParams(array $params);

    public function setParam($name, $value);

    public function setHeaders($headers);



    public function setCookie($cookie);



    public function setData($data);


    /*temp

    public function getParams();


    public function getParam($name);


    public function getData();



    public function getCookie();


    public function getHeaders();

*/





}