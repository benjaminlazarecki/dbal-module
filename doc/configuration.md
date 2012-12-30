# Configuration

In order to use the module, you need to provide your connection(s) informations such as driver, username, password, etc.

## Simple Connection

The module options does not make difference between simple or multiple connections. The following one shows you a
full example which does not need to be explain except for parameters which refers to the available
[Fridge DBAL ones](http://fridge-project.org/dbal/book/connection.html).

``` php
return array(
    'fridge_dbal' => array(
        'default_connection' => 'default',
        'connections' => array(
            'default' => array(
                'parameters' => array(
                    'driver'      => 'pdo_mysql',
                    'username'    => 'username',
                    'password'    => 'password',
                    'dbname'      => 'database',
                    'host'        => '127.0.0.1',
                    'port'        => 3306,
                    'unix_socket' => '/var/run/mysqld/mysqld.sock',
                    'charset'     => 'utf8',
                    'driver_options' => array(
                        'foo' => 'bar',
                    ),
                ),
            ),
        ),
    ),
);
```

## Multiple Connections

The module allows you to define as many connections you want. The following example shows you two connections.

``` php
return array(
    'fridge_dbal' => array(
        'default_connection' => 'database1',
        'connections' => array(
            'database1' => array(
                'parameters' => array(
                    'driver'   => 'pdo_mysql',
                    'username' => 'username1',
                    'password' => 'password1',
                ),
            ),
            'database2' => array(
                'parameters' => array(
                    'driver'   => 'pdo_mysql',
                    'username' => 'username2',
                    'password' => 'password2',
                ),
            ),
        ),
    ),
);
```

## Mapped & Custom Types

Like explain in the Fridge DBAL [Platform](http://fridge-project.org/dbal/book/platform.html) &
[Type](http://fridge-project.org/dbal/book/type.html) documentation, you can define mapped & custom types. The
following configuration shows you all of them.

``` php
return array(
    'fridge_dbal' => array(
        'default_connection' => 'default',
        'connections' => array(
            'default' => array(
                'parameters' => array(
                    'driver'   => 'pdo_mysql',
                    'username' => 'username',
                    'password' => 'password',
                ),
                'mapped_types' => array(
                    'strict'      => false,
                    'fallback'    => 'text',
                    'mandatories' => array('enum'),
                    'customs'     => array(
                        'enum' => 'enum'
                    ),
                ),
            ),
        ),
        'types' => array(
            'enum' => 'Fridge\DBAL\Type\TextType',
        )
    ),
);
```

## Custom Driver & Connection

If you want to define your own ``Driver`` or ``Connection`` implementation, you can use the ``driver_class`` or
``connection_class`` parameters.

``` php
return array(
    'fridge_dbal' => array(
        'default_connection' => 'default',
        'connections' => array(
            'default' => array(
                'parameters' => array(
                    'driver_class'     => 'Fridge\DBAL\Driver\PDO\MySQLDriver',
                    'connection_class' => 'Fridge\DBAL\Connection\Connection',
                    'username'         => 'username',
                    'password'         => 'password',
                ),
            ),
        ),
    ),
);
```
