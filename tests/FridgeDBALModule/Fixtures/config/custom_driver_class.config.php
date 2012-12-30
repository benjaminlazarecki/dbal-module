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
    'fridge_dbal' => array(
        'default_connection' => 'default',
        'connections' => array(
            'default' => array(
                'parameters' => array(
                    'driver_class' => 'Fridge\DBAL\Driver\PDO\MySQLDriver',
                    'username'     => 'username',
                    'password'     => 'password',
                ),
            ),
        ),
    ),
);
