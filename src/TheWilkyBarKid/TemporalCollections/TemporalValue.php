<?php

namespace TheWilkyBarKid\TemporalCollections;

use DateTime;
use InvalidArgumentException;

/**
 * Temporal value.
 *
 * @author Chris Wilkinson <chriswilkinson84@gmail.com>
 */
class TemporalValue
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var DateTime|null
     */
    private $effectiveFrom;

    /**
     * @var DateTime|null
     */
    private $effectiveTo;

    /**
     * Constructor.
     *
     * @param mixed         $value
     * @param DateTime|null $effectiveFrom
     * @param DateTime|null $effectiveTo
     *
     * @throws InvalidArgumentException
     */
    public function __construct($value, DateTime $effectiveFrom = null, DateTime $effectiveTo = null)
    {
        if (null !== $effectiveFrom && null !== $effectiveTo && $effectiveTo < $effectiveFrom) {
            throw new InvalidArgumentException('To date must on or after the from date');
        }

        $this->value = $value;
        $this->effectiveFrom = $effectiveFrom;
        $this->effectiveTo = $effectiveTo;
    }

    /**
     * Get value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get effective from date.
     *
     * @return DateTime|null
     */
    public function getEffectiveFrom()
    {
        if ($this->effectiveFrom instanceof DateTime) {
            return clone $this->effectiveFrom;
        }

        return $this->effectiveFrom;
    }

    /**
     * Get effective to date.
     *
     * @return DateTime|null
     */
    public function getEffectiveTo()
    {
        if ($this->effectiveTo instanceof DateTime) {
            return clone $this->effectiveTo;
        }

        return $this->effectiveTo;
    }
}
