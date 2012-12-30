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
                    'driver'   => 'pdo_pgsql',
                    'username' => 'username2',
                    'password' => 'password2',
                ),
            ),
        ),
    ),
);
