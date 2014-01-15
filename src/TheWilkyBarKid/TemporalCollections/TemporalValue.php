<?php

namespace TheWilkyBarKid\TemporalCollections;

use DateTime;

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
     */
    public function __construct($value, DateTime $effectiveFrom = null, DateTime $effectiveTo = null)
    {
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
