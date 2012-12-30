<?php

/*
 * This file is part of the Fridge DBAL module package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace FridgeDBALModule\Tests\Options;

use FridgeDBALModule\Options\ConnectionParametersOptions;

/**
 * Connection parameters options test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConnectionParametersOptionsTest extends \PHPUnit_Framework_TestCase
{
    /** @var \FridgeDBALModule\Options\ConnectionParametersOptions */
    protected $parameters;

    /** @var array */
    protected $options;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->options = array(
            'connection_class' => 'Fridge\DBAL\Connection\Connection',
            'driver_class'     => 'Fridge\DBAL\Driver\PDO\MySQLDriver',
            'driver'           => 'pdo_mysql',
            'username'         => 'username',
            'password'         => 'password',
            'dbname'           => 'database',
            'host'             => 'host',
            'port'             => 3306,
            'unix_socket'      => '/var/run/mysqld/mysqld.sock',
            'charset'          => 'utf8',
            'driver_options'   => array(
                'foo' => 'bar',
            ),
        );

        $this->parameters = new ConnectionParametersOptions($this->options);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->parameters);
        unset($this->options);
    }

    public function testConnectionClass()
    {
        $this->assertSame($this->options['connection_class'], $this->parameters->getConnectionClass());
    }

    public function testDriverClass()
    {
        $this->assertSame($this->options['driver_class'], $this->parameters->getDriverClass());
    }

    public function testDriver()
    {
        $this->assertSame($this->options['driver'], $this->parameters->getDriver());
    }

    public function testUsername()
    {
        $this->assertSame($this->options['username'], $this->parameters->getUsername());
    }

    public function testPassword()
    {
        $this->assertSame($this->options['password'], $this->parameters->getPassword());
    }

    public function testDbname()
    {
        $this->assertSame($this->options['dbname'], $this->parameters->getDbname());
    }

    public function testHost()
    {
        $this->assertSame($this->options['host'], $this->parameters->getHost());
    }

    public function testPort()
    {
        $this->assertSame($this->options['port'], $this->parameters->getPort());
    }

    public function testUnixSocket()
    {
        $this->assertSame($this->options['unix_socket'], $this->parameters->getUnixSocket());
    }

    public function testCharset()
    {
        $this->assertSame($this->options['charset'], $this->parameters->getCharset());
    }

    public function testDriverOptions()
    {
        $this->assertSame($this->options['driver_options'], $this->parameters->getDriverOptions());
    }
}
