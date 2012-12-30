<?php

/*
 * This file is part of the Fridge DBAL module package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace FridgeDBALModule\Exception;

/**
 * Fridge DBAL module options exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OptionsException extends Exception
{
    /**
     * Gets the "CONNECTION DOES NOT EXIST" exception.
     *
     * @param string $connection The connection name.
     *
     * @return \FridgeDBALModule\Exception\OptionsException The "CONNECTION DOES NOT EXIST" exception.
     */
    static public function connectionDoesNotExist($connection)
    {
        return new static(sprintf('The connection "%s" does not exist.', $connection));
    }

    /**
     * Gets the "OPTION DOES NOT EXIST" exception.
     *
     * @param string $connection The option name.
     *
     * @return \FridgeDBALModule\Exception\OptionsException The "OPTION DOES NOT EXIST" exception.
     */
    static public function optionDoesNotExist($option)
    {
        return new static(sprintf('The option "%s" does not exist.', $option));
    }
}
