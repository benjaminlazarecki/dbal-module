# Configuration

## Introduction

Before speaking about the module configuration itself, I would like to speak a little bit about the zf2 skeleton one.
If you don't use it, you can skip this part but it will explain a practice which should be used in all projects.

Basically, the zf2 configuration lives in the `config` folder placed in the project root directory. The configuration
is divided between the `application.config.php` where you define your modules & the `autoload` directory where you put
your modules configuration files. By default, these files must follows the pattern `*.global.php` or `*.local.php` in
order to be loaded (see the `application.config.php` file). The most important part is the fact that every
`*.local.php` files are git ignored. That means you should put **unsensitive** datas in the `*.global.php` files &
**sensitive** datas like username or password in the `*.local.php` files. Then, only safe datas will be versionned &
password will be kept private :)

If you would like more informations, you can read this [section](http://framework.zend.com/manual/2.0/en/modules/zend.mvc.services.html#default-configuration-options)
of the official zf2 documentation.

To help you, the module provides a [configuration skeleton](https://github.com/fridge-project/dbal-module/tree/master/tests/FridgeDBALModule/Fixtures/config/skeleton)
which can be used as starting point for your project.

## Simple Connection

In order to use the module, you need to provide your connection(s) informations such as driver, username, password, etc.

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
