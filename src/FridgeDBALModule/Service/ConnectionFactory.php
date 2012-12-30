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

use Fridge\DBAL\Connection\ConnectionInterface,
    Fridge\DBAL\ConnectionFactory as DBALFactory,
    Fridge\DBAL\Event\Subscriber\SetCharsetSubscriber,
    FridgeDBALModule\Options\ConnectionMappedTypesOptions,
    FridgeDBALModule\Options\ConnectionParametersOptions;

/**
 * Connection factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConnectionFactory
{
    /**
     * Creates a DBAL connection.
     *
     * @param \FridgeDBALModule\Options\ConnectionParametersOptions  $parametersOptions  The parameters options.
     * @param \FridgeDBALModule\Options\ConnectionMappedTypesOptions $mappedTypesOptions The mapped types options.
     *
     * @return \Fridge\DBAL\Connection\ConnectionInterface The DBAL connection.
     */
    public function create(
        ConnectionParametersOptions $parametersOptions,
        ConnectionMappedTypesOptions $mappedTypesOptions = null
    )
    {
        $connection = DBALFactory::create($parametersOptions->toArray());

        if ($mappedTypesOptions !== null) {
            $this->setMappedTypes($connection, $mappedTypesOptions);
        }

        if ($parametersOptions->getCharset() !== null) {
            $this->registerSetCharsetSubscriber($parametersOptions->getCharset(), $connection);
        }

        return $connection;
    }

    /**
     * Sets the mapped types on a connection.
     *
     * @param \Fridge\DBAL\Connection\ConnectionInterface            $connection         The connection.
     * @param \FridgeDBALModule\Options\ConnectionMappedTypesOptions $mappedTypesOptions The mapped types.
     */
    protected function setMappedTypes(
        ConnectionInterface $connection,
        ConnectionMappedTypesOptions $mappedTypesOptions
    )
    {
        if ($mappedTypesOptions->getStrict() !== null) {
            $connection->getPlatform()->useStrictMappedType($mappedTypesOptions->getStrict());
        }

        if ($mappedTypesOptions->getFallback() !== null) {
            $connection->getPlatform()->setFallbackMappedType($mappedTypesOptions->getFallback());
        }

        if ($mappedTypesOptions->getCustoms() !== array()) {
            foreach ($mappedTypesOptions->getCustoms() as $databaseType => $fridgeType) {
                $connection->getPlatform()->addMappedType($databaseType, $fridgeType);
            }
        }

        if ($mappedTypesOptions->getMandatories() !== array()) {
            foreach ($mappedTypesOptions->getMandatories() as $mandatoryType) {
                $connection->getPlatform()->addMandatoryType($mandatoryType);
            }
        }
    }

    /**
     * Registers a set charset subsriber on a connection.
     *
     * @param string                                      $charset    The charset.
     * @param \Fridge\DBAL\Connection\ConnectionInterface $connection The connection.
     */
    protected function registerSetCharsetSubscriber($charset, ConnectionInterface $connection)
    {
        $setCharsetSubscriber = new SetCharsetSubscriber($charset);

        $connection->getConfiguration()->getEventDispatcher()->addSubscriber($setCharsetSubscriber);
    }
}
