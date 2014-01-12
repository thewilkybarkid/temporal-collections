<?php

namespace spec\TheWilkyBarKid\TemporalCollections;

/**
 * Open-ended temporal collection spec.
 *
 * @author Chris Wilkinson <chriswilkinson84@gmail.com>
 */
class OpenEndedTemporalCollectionSpec extends AbstractTemporalCollectionSpec
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('TheWilkyBarKid\TemporalCollections\OpenEndedTemporalCollection');
        parent::it_is_initializable();
    }
}
