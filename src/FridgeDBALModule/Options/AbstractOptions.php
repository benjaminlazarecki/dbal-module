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

use FridgeDBALModule\Exception\OptionsException,
    Zend\Stdlib\AbstractOptions as BaseOptions,
    Zend\Stdlib\Exception\BadMethodCallException;

/**
 * Abstract options.
 *
 * It overrides the default one for giving better exception message.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractOptions extends BaseOptions
{
    /**
     * {@inheritdoc}
     *
     * @throws \FridgeDBALModule\Exception\OptionsException If the option does not exist.
     */
    public function __set($key, $value)
    {
        try {
            parent::__set($key, $value);
        } catch (BadMethodCallException $e) {
            throw OptionsException::optionDoesNotExist($key);
        }
    }
}
