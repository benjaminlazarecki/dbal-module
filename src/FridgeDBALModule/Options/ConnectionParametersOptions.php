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
 * Fridge DBAL module connection parameters options.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConnectionParametersOptions extends AbstractOptions
{
    /** @var string */
    protected $connectionClass;

    /** @var string */
    protected $driverClass;

    /** @var string */
    protected $driver;

    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    /** @var string */
    protected $dbname;

    /** @var string */
    protected $host;

    /** @var integer */
    protected $port;

    /** @var string */
    protected $unixSocket;

    /** @var string */
    protected $charset;

    /** @var array */
    protected $driverOptions;

    /**
     * {@inheritdoc}
     */
    public function __construct($options = null)
    {
        $this->driverOptions = array();

        parent::__construct($options);
    }

    /**
     * Gets the connection class parameter.
     *
     * @return string The connection class parameter.
     */
    public function getConnectionClass()
    {
        return $this->connectionClass;
    }

    /**
     * Sets the connection class parameter.
     *
     * @param string $connectionClass The connection class parameter.
     */
    public function setConnectionClass($connectionClass)
    {
        $this->connectionClass = $connectionClass;
    }

    /**
     * Gets the connection driver class parameter.
     *
     * @return string The connection driver class parameter.
     */
    public function getDriverClass()
    {
        return $this->driverClass;
    }

    /**
     * Sets the connection driver class parameter.
     *
     * @param string $driverClass The connection driver class parameter.
     */
    public function setDriverClass($driverClass)
    {
        $this->driverClass = $driverClass;
    }

    /**
     * Gets the connection driver parameter.
     *
     * @return string The connection driver parameter.
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Sets the connection driver parameter.
     *
     * @param string $driver The connection driver parameter.
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * Gets the connection username parameter.
     *
     * @return string The connection username parameter.
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the connection username parameter.
     *
     * @param string $username The connection username parameter.
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Gets the connection password parameter.
     *
     * @return string The connection password parameter.
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the connection password parameter.
     *
     * @param string $password The connection password parameter.
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Gets the connection database name parameter.
     *
     * @return string The connection database name parameter.
     */
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * Sets the connection database name parameter.
     *
     * @param string $dbname The connection database name parameter.
     */
    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
    }

    /**
     * Gets the connection host parameter.
     *
     * @return string The connection host parameter.
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Sets the connection host parameter.
     *
     * @param string $host The connection host parameter.
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Gets the connection port parameter.
     *
     * @return integer The connection port parameter.
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Sets the connection port parameter.
     *
     * @param integer $port The connection port parameter.
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Gets the connection unix socket parameter.
     *
     * @return string The connection unix socket parameter.
     */
    public function getUnixSocket()
    {
        return $this->unixSocket;
    }

    /**
     * Sets the connection unix socket parameter.
     *
     * @param string $unixSocket The connection unix socket parameter.
     */
    public function setUnixSocket($unixSocket)
    {
        $this->unixSocket = $unixSocket;
    }

    /**
     * Gets the connection charset parameter.
     *
     * @return string The connection charset parameter.
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Sets the connection charset parameter.
     *
     * @param string $charset The connection charset parameter.
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * Gets the connection driver options parameter.
     *
     * @return array The connection driver options parameter.
     */
    public function getDriverOptions()
    {
        return $this->driverOptions;
    }

    /**
     * Sets the connection driver options parameter.
     *
     * @param array $driverOptions The connection driver options parameter.
     */
    public function setDriverOptions(array $driverOptions)
    {
        $this->driverOptions = $driverOptions;
    }
}
