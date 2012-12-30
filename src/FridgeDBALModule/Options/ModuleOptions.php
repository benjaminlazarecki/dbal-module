<?php

/*
 * This file is part of the Fridge DBAL module package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace FridgeDBALModule\Options;

use FridgeDBALModule\Exception\OptionsException;

/**
 * Fridge DBAL module options.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ModuleOptions extends AbstractOptions
{
    /** @var string */
    protected $defaultConnection;

    /** @var array */
    protected $connections;

    /** @var array */
    protected $types;

    /**
     * {@inheritdoc}
     */
    public function __construct($options = null)
    {
        $this->defaultConnection = 'default';
        $this->connections = array();
        $this->types = array();

        parent::__construct($options);
    }

    /**
     * Gets the default connection name.
     *
     * @return string The default connection name.
     */
    public function getDefaultConnection()
    {
        if ($this->defaultConnection === null) {
            $this->defaultConnection = 'default';
        }

        return $this->defaultConnection;
    }

    /**
     * Sets the default connection name.
     *
     * @param string $connection The default connection name.
     */
    public function setDefaultConnection($connection)
    {
        $this->defaultConnection = $connection;
    }

    /**
     * Gets the connections options.
     *
     * @return array The connections options.
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * Sets the connections options.
     *
     * @param array $connections The connections options.
     */
    public function setConnections(array $connections)
    {
        foreach ($connections as $name => $connection) {
            $this->setConnection($name, $connection);
        }
    }

    /**
     * Gets a connection options.
     *
     * @param string $name The connection name.
     *
     * @throws \Fridge\DBALModule\Exception\OptionsException If the connection does not exist.
     *
     * @return \Fridge\DBALModule\Options\ConnectionOptions The connection options.
     */
    public function getConnection($name)
    {
        if (!isset($this->connections[$name])) {
            throw OptionsException::connectionDoesNotExist($name);
        }

        return $this->connections[$name];
    }

    /**
     * Sets a connection.
     *
     * @param string $name       The connection name.
     * @param array  $connection The connection options.
     */
    public function setConnection($name, array $connection)
    {
        $this->connections[$name] = new ConnectionOptions($connection);
    }

    /**
     * Gets the types.
     *
     * @return array The types.
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Sets the types.
     *
     * @param array $types The types.
     */
    public function setTypes(array $types)
    {
        $this->types = $types;
    }
}
