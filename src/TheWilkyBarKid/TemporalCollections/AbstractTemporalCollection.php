<?php

namespace TheWilkyBarKid\TemporalCollections;

use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use InvalidArgumentException;

/**
 * Abstract temporal collection.
 *
 * @author Chris Wilkinson <chriswilkinson84@gmail.com>
 */
abstract class AbstractTemporalCollection implements TemporalCollection
{
    protected $collection = array('' => null);

    public function set($value, $effectiveFrom = null, $effectiveTo = null)
    {
        $effectiveFrom = $this->guardDate($effectiveFrom);
        $effectiveTo = $this->guardDate($effectiveTo);

        if (null !== $effectiveFrom && null !== $effectiveTo && $effectiveFrom > $effectiveTo) {
            throw new InvalidArgumentException('End date must be on or after from date');
        }

        $currentValue = $this->get($effectiveTo);
        $key = $this->getCollectionKey($effectiveFrom);

        $this->collection[$key] = $value;

        if (null !== $effectiveTo) {
            $newKey = clone $effectiveTo;
            $newKey = $newKey->modify('+1 second');

            $this->collection[$this->getCollectionKey($newKey)] = $currentValue;
        }

        krsort($this->collection);

        if ($this->count() > 1) {
            if (null === $effectiveFrom && null === $effectiveTo) {
                $this->collection = array($key => $value);

                return;
            }

            foreach ($this->collection as $key => $value) {
                if ('' === $key) {
                    break;
                }

                $keyDateTime = new DateTime($key, new DateTimeZone('UTC'));

                if (null !== $effectiveTo) {
                    if ($keyDateTime > $effectiveTo) {
                        continue;
                    }
                }

                if ($keyDateTime == $effectiveFrom) {
                    break;
                }

                unset($this->collection[$key]);
            }

            $previousKey = null;

            foreach ($this->collection as $key => $value) {
                if (null !== $previousKey) {
                    if ($value == $this->collection[$previousKey]) {
                        unset($this->collection[$previousKey]);
                    }
                }

                $previousKey = $key;
            }
        }
    }

    public function get($date = null)
    {
        $date = $this->guardDate($date);

        reset($this->collection);

        if (null === $date) {
            return current($this->collection);
        }

        $key = $this->getCollectionKey($date);

        foreach ($this->collection as $effective => $value) {
            if ($effective <= $key) {
                return $value;
            }
        }

        return current($this->collection);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($value, $offset);
    }

    public function offsetExists($offset)
    {
        return true;
    }

    public function offsetUnset($offset)
    {
        $this->set(null, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function count()
    {
        return count($this->collection);
    }

    protected function getCollectionKey($date)
    {
        if (null === $date) {
            return '';
        }

        return $date->format('Y-m-d\TH:i:s');
    }

    protected function guardDate($date = null)
    {
        if (null === $date) {
            return null;
        } elseif (true === $date instanceof DateTime || true === $date instanceof DateTimeInterface) {
            return DateTime::createFromFormat(
                DateTime::ISO8601,
                $date->format(DateTime::ISO8601),
                new DateTimeZone('UTC')
            );
        }

        try {
            return new DateTime($date, new DateTimeZone('UTC'));
        } catch (Exception $e) {
            if (true === is_string($date)) {
                throw new InvalidArgumentException('"' . $date . '" is not parsable as a date/time', null, $e);
            }

            throw new InvalidArgumentException('Expected a date object or string, got ' . gettype($date), null, $e);
        }
    }
}
