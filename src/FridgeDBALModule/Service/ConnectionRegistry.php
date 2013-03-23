<?php

/*
 * This file is part of the Fridge DBAL module package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace FridgeDBALModule\Service;

use Fridge\DBAL\Type\Type;
use FridgeDBALModule\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Connection registry.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConnectionRegistry implements FactoryInterface
{
    /** @var \FridgeDBALModule\Service\ConnectionFactory */
    protected $factory;

    /** @var \FridgeDBALModule\Options\ModuleOptions */
    protected $options;

    /** @var array */
    protected $connections;

    /**
     * Creates a connection registry.
     */
    public function __construct()
    {
        $this->factory = new ConnectionFactory();
        $this->connections = array();
    }

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $this->options = new ModuleOptions($config['fridge_dbal']);
        $this->setTypes($this->options->getTypes());

        return $this;
    }

    /**
     * Gets the connecion factory.
     *
     * @return \FridgeDBALModule\Service\ConnectionFactory The connection factory.
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * Gets the module options.
     *
     * @return \FridgeDBALModule\Options\ModuleOptions The module options.
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Gets the connections.
     *
     * @return array The connections.
     */
    public function getConnections()
    {
        foreach (array_keys($this->options->getConnections()) as $name) {
            $this->getConnection($name);
        }

        return $this->connections;
    }

    /**
     * Gets the default connection.
     *
     * @return \Fridge\DBAL\Connection\ConnectionInterface The default connection.
     */
    public function getDefaultConnection()
    {
        return $this->getConnection($this->options->getDefaultConnection());
    }

    /**
     * Gets a connection.
     *
     * @param string $name The connection name.
     *
     * @return \Fridge\DBAL\Connection\ConnectionInterface The connection.
     */
    public function getConnection($name)
    {
        if (!isset($this->connections[$name])) {
            $this->connections[$name] = $this->factory->create(
                $this->options->getConnection($name)->getParameters(),
                $this->options->getConnection($name)->getMappedTypes()
            );
        }

        return $this->connections[$name];
    }

    /**
     * Sets the registered types.
     *
     * @param array $types The types.
     */
    protected function setTypes(array $types)
    {
        foreach ($types as $type => $class) {
            if (Type::hasType($type)) {
                Type::overrideType($type, $class);
            } else {
                Type::addType($type, $class);
            }
        }
    }
}
