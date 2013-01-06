# Usage

## Services

The module as been designed around the service `fridge.dbal` which is a connection registry
(`FridgeDBALModule\Service\ConnectionRegistry`). This service gives you access to all configured connections.

To get it, simply call the service manager:

``` php
$connectonRegistry = $serviceManager->get('fridge.dbal');
```

The connection registry is configured according to your configuration, so, we will take this one as reference:

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
                    'charset'  => 'utf8',
                ),
            ),
        ),
    ),
);
```

The configuration defines a `foo` connection which is the default connection too. To get it, you can use the
`getConnection` method or the `getDefaultConnection` method as `foo` is the default one:

``` php
/* @var $connection \Fridge\DBAL\Connection\ConnectionInterface */
$connection = $connectionRegistry->getConnection('foo');
$connection = $connectionRegistry->getDefaultConnection();
```

Additionally, we have provided a **charset** (utf8) for the `foo` connection. Doing that will automatically create &
register a `Fridge\DBAL\Event\Subscriber\SetCharsetSubscriber` on the `foo` connection event dispatcher. This object
sets the provided charset on the connection when it is established.
