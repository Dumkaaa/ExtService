<?php


namespace ExtService;

use ExtService\Interfaces\Request as IRequest;
use Bitrix\Main\Web\HttpClient;

/**
 * Объект с запросом к сервису
 */
class BaseRequest extends HTTPClient implements IRequest
{
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
        $this->setParams($params);
    }

    /**
     * Задает параметры запроса из массива
     * @param array $params
     * @return \soglasie\services\interfaces\Request
     */
    public function setParams(array $params)
    {
        foreach ($params as $name => $value) {
            $this->setParam($name, $value);
        }
        return $this;
    }

    /**
     * override
     * Задает параметр запроса
     * @param string $name
     * @param mixed  $value
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
     * Задает заголовки запроса
     * @param string $name
     * @param string $value
     * @param bool   $replace
     * @return $this
     */
    public function setHeader($name, $value, $replace = true)
    {
        parent::setHeader(trim($name), $value, $replace);
        return $this;
    }

    /**
     * Задает куки запроса
     * @param string $name
     * @param string $value
     * @param bool   $replace
     * @return $this
     */
    public function setCookies(array $cookies)
    {
        parent::setCookies($cookies);
        return $this;
    }


}