<?php


namespace ExtService\Interfaces;

interface Response
{
    /*need*/

    public function __construct(array $params = null);



    public function getHeaders(); /**/

    public function setHeaders($headers);

    public function getCookie(); /**/

    public function setCookie($cookie);

    public function getData();  /**/

    public function setData($data);

    public function getError();

    public function setError($message);

    public function getStatus();

    public function setStatus($status);


















}