# Usage

The module as been designed around a service: `fridge.dbal`. This service gives you access to all configured
connections.

To get it, simply call the service locator:

``` php
/* @var $connectionRegistry \FridgeDBALModule\Service\ConnectionRegistry */
$connectonRegistry = $serviceLocator->get('fridge.dbal');
```

For the next part, take this configuration as reference:

``` php
return array(
    'fridge_dbal' => array(
        'default_connection' => 'foo',
        'connections' => array(
            'foo' => array(
                'parameters' => array(
                    'driver'   => 'pdo_mysql',
                    'username' => 'username',
                    'password' => 'password',
                ),
            ),
        ),
    ),
);
```

To get your `foo` connection, you can use `getConnection` on the registry or use `getDefaultConnection` as `foo` is the
default connection:

``` php
/* @var $connection \Fridge\DBAL\Connection\ConnectionInterface */
$connection = $connectionRegistry->getConnection('foo');
$connection = $connectionRegistry->getDefaultConnection();
```
