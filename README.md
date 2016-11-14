# ExtService
Библиотека для работы с внешними сервисами (под Битрикс)

Установка
------------

С использованием [composer](http://getcomposer.org/download/).

В файле `composer.json` в секцию **require** добавить:

```
"dumkaaa/ExtService": "dev-master"
```

в секцию **repositories**:

```
      {
        "type": "git",
        "url": "https://github.com/dumkaaa/ExtService"
      }
```
Выполнить команду
```
composer install
```



Настройка
-----

В общем случае для каждого сервиса должен быть создан файл Service.php  в папке `/lib/model/название_сервиса`, который должен лежать в своем пространстве имен в подпространстве `app\model` и расширять базовый класс `BaseService`.


Базовое использование
-----


```php
namespace app\model\virtu;

use ExtService\BaseService;

class Service extends BaseService
{    

    /**
     * Получение списка стран
     * @param Request $request Объект запроса
     * @return \ExtService\Interfaces\Response Объект ответа
     */
    protected function getCountry(Request $request)
    {
        $request->setParams([
            'method'  => 'GET',
            'url'     => $this->_url . '/ClassifierFeature/Classifier.dat',
            'headers' => [
                'x-vs-parameters' => json_encode([
                    "productId" => $this->getProductId($request),
                    "fieldList" => $this->getFieldList(),
                    "id" => "693d344f-6efd-4e88-9c45-7e293f94d64d"
                ])
            ]
        ]);
        return $this->query($request, new Response());
    }
```

Дополнительные параметры
-----


При необходимости, возможно расширять и переопределять не только базовый класс сервиса, но и классы запроса (должен расширять `ExtService\BaseRequest`) и ответа  (`ExtService\Response`). 

В запросах и ответах можно управлять заголовками, cookies, устанавливать методы, другими данными, а также читать данные и обрабатывать ошибки.

Полная структура в таком случае будет выглядеть примерно следующим образом:
```
/lib
├── название_сервиса
|   ├── Service.php 
|   ├── Request.php
|   └── Response.php
└── название_другого_сервиса
    ├── Service.php 
    ├── Request.php
    └── Response.php
```

Также, для удобства можно использовать [bxpimple](https://github.com/marvin255/bxpimple) для удобного подключения сервисов:
```php
Locator::$item->registerFactories([

	'VirtuService' => function ($c) {
		$model = new \app\model\virtu\Service();
		return $model;
	},

	'VirtuRequest' => function ($c) {
		$model = new \app\model\virtu\Request();
		return $model;
	},

]);
```
и вызова их, в последствии:
```
$virtu = \bxpimple\Locator::$item->get('VirtuService');
```