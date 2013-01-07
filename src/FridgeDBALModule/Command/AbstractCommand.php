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

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Base Fridge DBAL command.
 *
 * All commands must extend this class.
 *
 * @author Benjamin Lazarecki <benjamin@widop.com>
 */
abstract class AbstractCommand extends AbstractActionController
{
    /**
     * Execute a command.
     *
     * @return string The command output.
     */
    abstract public function execute();

    /**
     * Gets a Fridge DBAL connection.
     *
     * @param string|null $name The connection name or null for default connexion.
     *
     * @return \Fridge\DBAL\Connection\ConnectionInterface The Fridge DBAL connection.
     */
    protected function getConnection($name = null)
    {
        if ($name === null) {
            return $this->getServiceLocator()->get('fridge.dbal')->getDefaultConnection();
        }

        return $this->getServiceLocator()->get('fridge.dbal')->getConnection($name);
    }
}
