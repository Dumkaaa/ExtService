<?php

namespace ExtService;

use Bitrix\Main\Data\Cache;
use ExtService\Interfaces\Request as IRequest;
use ExtService\Interfaces\Response as IResponse;
use ExtService\Interfaces\Service as IService;

/**
 * Базовый класс для сервисовю Реализует обращение к методам и к стороннему апи
 */
class BaseService implements IService
{
    use Traits\BaseSetter, Traits\BaseGetter;

    /** @var array */
    protected $params = [];

    /**
     * Осуществляет HTTP запрос с сервису
     * @param IRequest $request Объект запроса
     * @param IResponse $response Объект ответа
     * @return IResponse
     */
    public function query(IRequest $request, IResponse $response)
    {
        $request->query(
            strtoupper($request->getMethod()),
            $request->getUrl(),
            $request->getBody()
        );

        $response->setData($request->getResult());
        $response->setCookies($request->getCookies());
        $response->setStatus($request->getStatus());

        return $response;
    }

    /**
     * Вызывает методы получения данных по имени
     * @param string $name Имя методы, например для getCatalog это будет Catalog
     * @param IRequest $request
     * @return IResponse | false
     */
    public function get($name, IRequest $request = null, $cacheTime = 43200)
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

                if(is_null($return)) {
                    $cache->abortDataCache();
                } elseif (is_object($return) && $return->getError()) {
                    $cache->abortDataCache();
                }
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
    public function action($name, IRequest $request = null, $cacheTime = 0)
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

                if(is_null($return)) {
                    $cache->abortDataCache();
                } elseif (is_object($return) && $return->getError()) {
                    $cache->abortDataCache();
                }
            }
            $cache->endDataCache($return);
        }
        return $return;
    }
}