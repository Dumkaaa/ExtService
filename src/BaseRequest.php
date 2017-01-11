<?php

namespace ExtService;

use Bitrix\Main\Web;
use ExtService\Interfaces\Request as IRequest;
use ExtService\Traits\BaseGetter;

/**
 * Объект с запросом к сервису
 */
class BaseRequest extends Web\HttpClient implements IRequest
{
    use BaseGetter;
    /**
     * @var array
     */
    protected $_params = [];


    /**
     * Конструктор
     * @param array $params
     */
    public function __construct(array $params = null)
    {
        $this->requestHeaders = new Web\HttpHeaders();
        $this->responseHeaders = new Web\HttpHeaders();
        $this->requestCookies = new Web\HttpCookies();
        $this->responseCookies = new Web\HttpCookies();
        $this->setParams($params);
        $this->setCompress(true);
        $this->setVersion("1.1");
    }

    /**
     * Задает параметры запроса из массива
     * @param array $params
     * @return BaseRequest
     */
    public function setParams(array $params = null, $boolClean = true)
    {
        $this->requestHeaders = new Web\HTTPHeaders;

        if ($boolClean)
            $this->cleanParams();

        if (isset($params['cookies']))
            $this->setCookies($params['cookies']);

        if (isset($params['headers']))
            $this->setHeaders($params['headers']);

        foreach ($params as $name => $value) {
            $this->setParam($name, $value);
        }
        return $this;
    }

    public function cleanParams()
    {
        $this->_params = null;
        return $this;
    }

    public function setCookies(array $cookies)
    {
        $this->requestCookies->set($cookies);
    }

    /**
     * Задает заголовки запроса из массива
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value, true);
        }
        return $this;
    }

    /**
     * override
     * Задает параметр запроса
     * @param string $name
     * @param mixed $value
     * @return BaseRequest
     */
    public function setParam($name, $value)
    {
        $this->_params[trim($name)] = $value;
        return $this;
    }

    public function getMethod()
    {
        return $this->_params['method'];
    }

    public function getUrl()
    {
        return $this->_params['url'];
    }

    public function getBody()
    {
        return $this->_params['body'];
    }

    public function setAuthorization($user, $pass)
    {
        $this->setHeader("Authorization", "Basic " . base64_encode($user . ":" . $pass));
    }

    public function getHeaders()
    {
        return $this->responseHeaders;
    }

    public function getCookies()
    {
        return $this->responseCookies;
    }


}