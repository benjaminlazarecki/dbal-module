# Usage

## Command

The module provides commands which ease common tasks:

* `fridge database create`: Creates a database.
* `fridge database drop`: Drops a database.
* `fridge database drop_and_create`: Drops & creates a database (if the database does not exist,
the command will only create it).

Each command uses by default the configured default_connection.
If you want to use an other one, you can also specify the connection name as argument:

`php public/index.php fridge database create --connection=name`

## Services

The module as been designed around the service `fridge.dbal` which is a connection registry
(`FridgeDBALModule\Service\ConnectionRegistry`). This service gives you access to all configured connections.

To get it, simply call the service manager:

``` php
$connectionRegistry = $serviceManager->get('fridge.dbal');
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
