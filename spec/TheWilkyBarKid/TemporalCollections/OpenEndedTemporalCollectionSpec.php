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
