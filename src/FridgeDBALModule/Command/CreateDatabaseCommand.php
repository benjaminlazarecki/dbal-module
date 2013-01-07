<?php

/*
 * This file is part of the Fridge DBAL module package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace FridgeDBALModule\Command;

use FridgeDBALModule\Exception\Exception;

/**
 * Command which creates a database according to any configured connections.
 *
 * @author Benjamin Lazarecki <benjamin@widop.com>
 */
class CreateDatabaseCommand extends AbstractCommand
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $name = $this->getRequest()->getParams('connection');

        $connection = $this->getConnection($name);

        try {
            $connection->getSchemaManager()->createDatabase($connection->getDatabase());

            $output = sprintf('Database for connection %s has been created successfully!', $name);
        } catch (Exception $e) {
            $output = sprintf('An error occurred when creating database for connection %s...', $name);
        }

        $connection->close();

        return $output;
    }
}
