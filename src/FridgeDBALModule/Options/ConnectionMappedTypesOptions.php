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
 * Fridge DBAL module connection mapped types options.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConnectionMappedTypesOptions extends AbstractOptions
{
    /** @var boolean */
    protected $strict;

    /** @var string */
    protected $fallback;

    /** @var array */
    protected $customs;

    /** @var array */
    protected $mandatories;

    /**
     * Gets the strict mapped type flag.
     *
     * @return boolean The strict mapped type flag.
     */
    public function getStrict()
    {
        return $this->strict;
    }

    /**
     * Sets the strict mapped type flag.
     *
     * @paral boolean $strict The strict mapped type flag.
     */
    public function setStrict($strict)
    {
        $this->strict = $strict;
    }

    /**
     * Gets the fallback mapped type.
     *
     * @return string The fallback mapped type.
     */
    public function getFallback()
    {
        return $this->fallback;
    }

    /**
     * Sets the fallback mapped type.
     *
     * @param string $fallback The fallback mapped type.
     */
    public function setFallback($fallback)
    {
        $this->fallback = $fallback;
    }

    /**
     * Gets the custom mapped types.
     *
     * @return array The custom mapped types.
     */
    public function getCustoms()
    {
        return $this->customs;
    }

    /**
     * Sets the custom mapped types.
     *
     * @param array $customs The custom mapped types.
     */
    public function setCustoms(array $customs)
    {
        $this->customs = $customs;
    }

    /**
     * Gets the mandatory mapped types.
     *
     * @return array The mandatory mapped types.
     */
    public function getMandatories()
    {
        return $this->mandatories;
    }

    /**
     * Sets the mandatory mapped types.
     *
     * @param array $mandatories The mandatory mapped types.
     */
    public function setMandatories(array $mandatories)
    {
        $this->mandatories = $mandatories;
    }
}
