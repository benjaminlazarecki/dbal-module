# Installation

## Composer

Require the module in your composer.json file:

```
{
    "require": {
        "fridge/dbal-module": "dev-master",
    }
}
```

Install the module:

```
$ composer update
```

Register the module:

``` php
// config/application.config.php

<?php
return array(
    'modules' => array(
        'FridgeDBALModule'
    ),
);
```

## Manually

Clone the module & third libraries in your `vendor` directory:

```
$ git clone git://github.com/fridge-project/dbal-module.git vendor/FridgeDBALModule
$ git clone git://github.com/fridge-project/dbal.git vendor/fridge-dbal
$ git clone git://github.com/Seldaek/monolog.git vendor/monolog
$ git clone git://github.com/symfony/EventDispatcher.git vendor/symfony/src/Symfony/EventDispatcher
```

Autoload third libraries:

``` php
// module/Application/Module.php

return array(
    'Zend\Loader\StandardAutoloader' => array(
        'namespaces' => array(
            __NAMESPACE__              => __DIR__.'/src/'.__NAMESPACE__,
            'Fridge\\DBAL'             => __DIR__.'/../../vendor/fridge-dbal/src',
            'Monolog'                  => __DIR__.'/../../vendor/monolog/src',
            'Symfony\\EventDisptacher' => __DIR__.'/../../vendor/symfony/src',
        ),
    ),
);
```

Register the module:

``` php
// config/application.config.php

<?php
return array(
    'modules' => array(
        'FridgeDBALModule'
    ),
);
```
