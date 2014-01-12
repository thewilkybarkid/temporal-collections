<?php

namespace TheWilkyBarKid\TemporalCollections;

use ArrayAccess;
use Countable;
use DateTime;
use DateTimeInterface;
use InvalidArgumentException;

/**
 * A temporal collection is a simple way to implement a temporal property, that
 * is a property that changes its value over time.
 *
 * @author Chris Wilkinson <chriswilkinson84@gmail.com>
 */
interface TemporalCollection extends ArrayAccess, Countable
{
    /**
     * Set value for a date/time.
     *
     * @param mixed                      $value
     * @param DateTime|DateTimeInterface $effectiveFrom
     * @param DateTime|DateTimeInterface $effectiveTo
     *
     * @throws InvalidArgumentException
     */
    public function set($value, $effectiveFrom = null, $effectiveTo = null);

    /**
     * Get value for a date/time.
     *
     * @param DateTime|DateTimeInterface|null $when
     *
     * @return mixed
     */
    public function get($when = null);
}
