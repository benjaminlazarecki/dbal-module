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

/**
 * Fridge DBAL module connection options.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConnectionOptions extends AbstractOptions
{
    /** @var \Fridge\DBALModule\Options\ConnectionParametersOptions */
    protected $parameters;

    /** @var \Fridge\DBALModule\Options\ConnectionMappedTypesOptions */
    protected $mappedTypes;

    /**
     * Gets the connection parameters configuration.
     *
     * @return \Fridge\DBALModule\Options\ConnectionParametersOptions The connection parameters options.
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Sets the connection parameters options.
     *
     * @param array $parameters The connection parameters options.
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = new ConnectionParametersOptions($parameters);
    }

    /**
     * Gets the connection mapped types options.
     *
     * @return \Fridge\DBALModule\Options\ConnectionMappedTypesOptions The connection mapped types options.
     */
    public function getMappedTypes()
    {
        return $this->mappedTypes;
    }

    /**
     * Sets the connection mapped types options.
     *
     * @param array $mappedTypes The connection mapped types options.
     */
    public function setMappedTypes(array $mappedTypes)
    {
        $this->mappedTypes = new ConnectionMappedTypesOptions($mappedTypes);
    }
}
