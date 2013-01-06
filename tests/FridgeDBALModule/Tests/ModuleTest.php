<?php

/*
 * This file is part of the Fridge DBAL module package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace FridgeDBALModule\Tests;

use Fridge\DBAL\Event\Events,
    Fridge\DBAL\Type\Type,
    Zend\Mvc\Application;

/**
 * Fridge DBAL module test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Zend\Mvc\Application */
    protected $application;

    /** @var array */
    protected $applicationConfiguration;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->applicationConfiguration = require __DIR__.'/../Fixtures/application.config.php';
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->application);
        unset($this->applicationConfiguration);
    }

    /**
     * Loads application global options.
     *
     * @param string $options The options name.
     */
    protected function loadOptions($options)
    {
        $this->applicationConfiguration['module_listener_options']['config_glob_paths'] = array(
            __DIR__.'/../Fixtures/config/'.$options.'.config.php',
        );
    }

    public function testWithoutOptions()
    {
        $this->application = Application::init($this->applicationConfiguration);

        $connectionRegistry = $this->application->getServiceManager()->get('fridge.dbal');

        $this->assertInstanceOf(
            'FridgeDBALModule\Service\ConnectionRegistry',
            $connectionRegistry
        );

        $this->assertInstanceOf('FridgeDBALModule\Service\ConnectionFactory', $connectionRegistry->getFactory());
        $this->assertInstanceOf('FridgeDBALModule\Options\ModuleOptions', $connectionRegistry->getOptions());
        $this->assertEmpty($connectionRegistry->getConnections());
    }

    /**
     * @expectedException \Zend\ServiceManager\Exception\ServiceNotCreatedException
     */
    public function testWithoutInvalidOptions()
    {
        $this->loadOptions('invalid_config');
        $this->application = Application::init($this->applicationConfiguration);

        $this->application->getServiceManager()->get('fridge.dbal');
    }

    public function testSimpleConnection()
    {
        $this->loadOptions('simple_connection');
        $this->application = Application::init($this->applicationConfiguration);

        $connectionRegistry = $this->application
            ->getServiceManager()
            ->get('fridge.dbal');

        $connection = $connectionRegistry->getConnection('default');

        $this->assertSame(array('default' => $connection), $connectionRegistry->getConnections());

        $this->assertInstanceOf('Fridge\DBAL\Driver\PDO\MySQLDriver', $connection->getDriver());
        $this->assertSame('username', $connection->getUsername());
        $this->assertSame('password', $connection->getPassword());
        $this->assertSame('database', $connection->getDatabase());
        $this->assertSame('127.0.0.1', $connection->getHost());
        $this->assertSame(3306, $connection->getPort());
        $this->assertSame(array('foo' => 'bar'), $connection->getDriverOptions());

        $defaultConnection = $this->application
            ->getServiceManager()
            ->get('fridge.dbal')
            ->getDefaultConnection();

        $this->assertSame($defaultConnection, $connection);
    }

    public function testMultipleConnections()
    {
        $this->loadOptions('multiple_connections');
        $this->application = Application::init($this->applicationConfiguration);

        $connectionRegistry = $this->application->getServiceManager()->get('fridge.dbal');

        $connection1 = $connectionRegistry->getConnection('database1');
        $connection2 = $connectionRegistry->getConnection('database2');

        $this->assertInstanceOf('Fridge\DBAL\Driver\PDO\MySQLDriver', $connection1->getDriver());
        $this->assertSame('username1', $connection1->getUsername());
        $this->assertSame('password1', $connection1->getPassword());

        $this->assertInstanceOf('Fridge\DBAL\Driver\PDO\PostgreSQLDriver', $connection2->getDriver());
        $this->assertSame('username2', $connection2->getUsername());
        $this->assertSame('password2', $connection2->getPassword());
    }

    /**
     * @expectedException \FridgeDBALModule\Exception\OptionsException
     * @expectedExceptionMessage The connection "foo" does not exist.
     */
    public function testInvalidDefaultConnection()
    {
        $this->loadOptions('invalid_default_connection');
        $this->application = Application::init($this->applicationConfiguration);

        $this->application
            ->getServiceManager()
            ->get('fridge.dbal')
            ->getDefaultConnection();
    }

    public function testCustomConnectionClass()
    {
        $this->loadOptions('custom_connection_class');
        $this->application = Application::init($this->applicationConfiguration);

        $connection = $this->application
            ->getServiceManager()
            ->get('fridge.dbal')
            ->getDefaultConnection();

        $this->assertInstanceOf('Fridge\DBAL\Connection\Connection', $connection);
    }

    public function testCustomDriverClass()
    {
        $this->loadOptions('custom_driver_class');
        $this->application = Application::init($this->applicationConfiguration);

        $connection = $this->application
            ->getServiceManager()
            ->get('fridge.dbal')
            ->getDefaultConnection();

        $this->assertInstanceOf('Fridge\DBAL\Driver\PDO\MySQLDriver', $connection->getDriver());
    }

    public function testCustomUnixSocket()
    {
        $this->loadOptions('custom_unix_socket');
        $this->application = Application::init($this->applicationConfiguration);

        $connection = $this->application
            ->getServiceManager()
            ->get('fridge.dbal')
            ->getDefaultConnection();

        $parameters = $connection->getParameters();

        $this->assertArrayHasKey('unix_socket', $parameters);
        $this->assertSame('/var/run/mysqld/mysqld.sock', $parameters['unix_socket']);
    }

    public function testCustomCharsetConnection()
    {
        $this->loadOptions('custom_charset');
        $this->application = Application::init($this->applicationConfiguration);

        $connection = $this->application
            ->getServiceManager()
            ->get('fridge.dbal')
            ->getDefaultConnection();

        $this->assertTrue($connection->getConfiguration()->getEventDispatcher()->hasListeners(Events::POST_CONNECT));
    }

    public function testCustomMappedType()
    {
        $this->loadOptions('custom_mapped_types');
        $this->application = Application::init($this->applicationConfiguration);

        $connection = $this->application
            ->getServiceManager()
            ->get('fridge.dbal')
            ->getDefaultConnection();

        $this->assertTrue(Type::hasType('enum'));
        $this->assertInstanceOf('Fridge\DBAL\Type\TextType', Type::getType('enum'));

        $this->assertInstanceOf('Fridge\DBAL\Type\TextType', Type::getType(Type::STRING));

        $this->assertFalse($connection->getPlatform()->useStrictMappedType());
        $this->assertSame(Type::TEXT, $connection->getPlatform()->getFallbackMappedType());

        $this->assertSame('enum', $connection->getPlatform()->getMappedType('enum'));
        $this->assertTrue($connection->getPlatform()->hasMandatoryType('enum'));
    }

    public function testSkeleton()
    {
        $this->applicationConfiguration['module_listener_options']['config_glob_paths'] = array(
            __DIR__.'/../Fixtures/config/skeleton/fridge_dbal.global.php',
            __DIR__.'/../Fixtures/config/skeleton/fridge_dbal.local.php',
        );

        $this->application = Application::init($this->applicationConfiguration);

        $connection = $this->application
            ->getServiceManager()
            ->get('fridge.dbal')
            ->getConnection('default');

        $this->assertInstanceOf('Fridge\DBAL\Driver\PDO\MySQLDriver', $connection->getDriver());
        $this->assertSame('username', $connection->getUsername());
        $this->assertSame('password', $connection->getPassword());
        $this->assertSame('database', $connection->getDatabase());
        $this->assertSame('127.0.0.1', $connection->getHost());
        $this->assertSame(3306, $connection->getPort());
        $this->assertTrue($connection->getConfiguration()->getEventDispatcher()->hasListeners(Events::POST_CONNECT));
    }
}
