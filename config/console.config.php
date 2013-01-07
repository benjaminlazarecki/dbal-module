<?php

/*
 * This file is part of the Fridge DBAL module package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'CreateCommand'        => 'FridgeDBALModule\Controller\CreateDatabaseCommand',
            'DropCommand'          => 'FridgeDBALModule\Controller\DropDatabaseCommand',
            'DropAndCreateCommand' => 'FridgeDBALModule\Controller\DropAndCreateDatabaseCommand',
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'create' => array(
                    'options' => array(
                        'route'    => 'fridge database create [--connection=]',
                        'defaults' => array(
                            'controller' => 'CreateCommand',
                            'action'     => 'execute'
                        )
                    )
                ),
                'drop' => array(
                    'options' => array(
                        'route'    => 'fridge database drop [--connection=]',
                        'defaults' => array(
                            'controller' => 'DropCommand',
                            'action'     => 'execute'
                        )
                    )
                ),
                'drop-and-create' => array(
                    'options' => array(
                        'route'    => 'fridge database drop_and_create [--connection=]',
                        'defaults' => array(
                            'controller' => 'DropAndCreateCommand',
                            'action'     => 'execute'
                        )
                    )
                ),
            )
        )
    ),
);
