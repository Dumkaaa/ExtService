<?php

namespace ExtService;

use Bitrix\Main\Data\Cache;
use ExtService\Interfaces\Request as IRequest;
use ExtService\Interfaces\Response as IResponse;
use ExtService\Interfaces\Service as IService;
use SoapClient;
use SoapFault;

/**
 * Базовый класс для сервисовю Реализует обращение к методам и к стороннему апи
 */
class SoapService extends SoapClient implements IService
{
    use Traits\BaseSetter, Traits\BaseGetter;

    /** @var array */
    protected $params = [];

    /**
     * Создание объекта и авторизация
     */
    public function __construct()
    {
        return parent::__construct(
            $this->url,
            [
                "login" => $this->login,
                "password" => $this->password,
            ]
        );
    }
    /**
     * Осуществляет HTTP запрос с сервису
     * @param IRequest $request Объект запроса
     * @param IResponse $response Объект ответа
     * @return IResponse
     */
    public function query(IRequest $request, IResponse $response)
    {
        try {
            $result = $this->__soapCall(
                $request->getParam("method"),
                [$request->getParam("body")]
            );
            $response->setData($result);
        } catch (SoapFault $soapFault) {
            $response->setData($this->__getLastResponse());
            $response->setStatus($this->__getLastResponseHeaders());
            $response->setError($soapFault);
        }
        return $response;
    }

    /**
     * Вызывает методы получения данных по имени
     * @param string $name Имя методы, например для getCatalog это будет Catalog
     * @param IRequest $request
     * @return IResponse | false
     */
    public function get($name, IRequest $request = null, $cacheTime = 1)
    {
        $return = false;
        $method = 'get' . ucfirst($name);

        $cache = Cache::createInstance();
        if ($cache->initCache($cacheTime, get_class($this) . $method)) {
            $return = $cache->getVars();
        } elseif ($cache->startDataCache()) {
            if (!is_callable(array($this, $method))) {
                $cache->abortDataCache();
                return $return;
            } else {
                $return = $this->$method();
            }
            $cache->endDataCache($return);
        }
        return $return;
    }

    /**
     * Вызывает методы обработки данных по имени
     * @param string $name Имя методы, например для actionSave это будет Save
     * @param IRequest $request
     * @return IResponse | false
     */
    public function action($name, IRequest $request = null, $cacheTime = 3)
    {
        $return = false;
        $method = 'action' . ucfirst($name);

        $cache = Cache::createInstance();
        if ($cache->initCache($cacheTime, get_class($this) . $method)) {
            $return = $cache->getVars();
        } elseif ($cache->startDataCache()) {
            if (!is_callable(array($this, $method))) {
                $cache->abortDataCache();
                return $return;
            } else {
                $return = $this->$method($request);
            }
            $cache->endDataCache($return);
        }
        return $return;
    }
}