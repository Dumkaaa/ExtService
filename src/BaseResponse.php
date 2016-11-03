<?php

namespace ExtService;

use ExtService\Interfaces\Response as IResponse;

/**
 * Объект с ответом от сервиса
 */
class BaseResponse implements IResponse
{
    /**
     * @var mixed
     */
    protected $_data = null;

    /**
     * Задает данные ответа
     * @param mixed $data
     * @return \soglasie\services\interfaces\Response
     */
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * Возвращает данные ответа
     * @return mixed
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @var mixed
     */
    protected $_cookie = null;
    /**
     * Задает куки ответа
     * @param mixed $data
     * @return \soglasie\services\interfaces\Response
     */
    public function setCookies($cookie)
    {
        $this->_cookie = $cookie;
        return $this;
    }

    /**
     * Возвращает куки ответа
     * @return mixed
     */
    public function getCookies()
    {
        return $this->_cookie;
    }

    /**
     * @var string
     */
    protected $_error_code = null;

    /**
     * Задает код ошибки
     * @param string $code
     * @return \soglasie\services\interfaces\Response
     */
    public function setStatus($code)
    {
        $this->_error_code = trim($code);
        return $this;
    }

    /**
     * Возвращает код ошибки
     * @return string
     */
    public function getStatus()
    {
        return $this->_error_code;
    }

    /**
     * @var string
     */
    protected $_error_message = null;

    /**
     * Задает сообщение об ошибке
     * @param string $message
     * @return \soglasie\services\interfaces\Response
     */
    public function setErrorMessage($message)
    {
        $this->_error_message = trim($message);
        return $this;
    }

    /**
     * Возвращает сообщение об ошибке
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_error_message;
    }
}