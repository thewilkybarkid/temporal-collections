<?php

/*
 * This file is part of the Temporal Collections library.
 *
 * (c) Chris Wilkinson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\TheWilkyBarKid\TemporalCollections;

use DateTimeImmutable;

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

    public function it_can_have_an_initial_value()
    {
        $this->beConstructedWith('foo');

        $this->get(null)->shouldReturn('foo');
        $this->get(new DateTimeImmutable('2000-01-01'))->shouldReturn('foo');
    }
}
