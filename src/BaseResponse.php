<?php

namespace ExtService;

use ExtService\Interfaces\Response;
use ExtService\Interfaces\Response as IResponse;

/**
 * Объект с ответом от сервиса
 */
class BaseResponse implements IResponse
{
    /**
     * @var mixed
     */
    protected $data = null;
    /**
     * /**
     * @var mixed
     */
    protected $cookie = null;
    /**
     * @var string
     */
    protected $error_code = null;
    /**
     * @var string
     */
    protected $error = null;

    /**
     * Возвращает данные ответа
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Задает данные ответа
     * @param mixed $data
     * @return Response
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Задает куки ответа
     * @param mixed $data
     * @return Response
     */
    public function setCookies($cookie)
    {
        $this->cookie = $cookie;
        return $this;
    }

    /**
     * Возвращает куки ответа
     * @return \Bitrix\Main\Web\HttpCookies
     */
    public function getCookies()
    {
        return $this->cookie;
    }

    /**
     * Задает код ошибки
     * @param string $code
     * @return Response
     */
    public function setStatus($code)
    {
        $this->error_code = trim($code);
        return $this;
    }

    /**
     * Возвращает код ошибки
     * @return string
     */
    public function getStatus()
    {
        return $this->error_code;
    }

    /**
     * Возвращает сообщение об ошибке
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Задает сообщение об ошибке
     * @param string $message
     * @return Response
     */
    public function setError($message)
    {
        $this->error = trim($message);
        return $this;
    }
}