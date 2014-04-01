<?php

/*
 * This file is part of the Temporal Collections library.
 *
 * (c) Chris Wilkinson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TheWilkyBarKid\TemporalCollections;

/**
 * Open-ended temporal collection, that is one without a start or end date.
 *
 * @author Chris Wilkinson <chriswilkinson84@gmail.com>
 */
class OpenEndedTemporalCollection extends AbstractTemporalCollection
{
    /**
     * Constructor.
     *
     * @param mixed $initialValue
     */
    public function __construct($initialValue = null)
    {
        $this->set($initialValue);
    }
}
