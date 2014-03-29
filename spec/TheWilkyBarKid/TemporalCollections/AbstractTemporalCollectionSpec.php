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

use DateTime;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;
use TheWilkyBarKid\TemporalCollections\TemporalValue;

/**
 * Abstract temporal collection spec.
 *
 * @author Chris Wilkinson <chriswilkinson84@gmail.com>
 */
abstract class AbstractTemporalCollectionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf('TheWilkyBarKid\TemporalCollections\TemporalCollection');
        $this->shouldBeAnInstanceOf('ArrayAccess');
        $this->shouldBeAnInstanceOf('Countable');
    }

    public function it_should_be_addable()
    {
        $this->get(new DateTimeImmutable('0000-01-01'))->shouldReturn(null);
        $this->get(new DateTimeImmutable('1950-01-01'))->shouldReturn(null);
        $this->get(new DateTimeImmutable('2000-01-01'))->shouldReturn(null);
        $this->get(new DateTimeImmutable('2050-01-01'))->shouldReturn(null);
        $this->get(null)->shouldReturn(null);

        $this->set('Foo', new DateTimeImmutable('2000-01-01'));
        $this->get(new DateTimeImmutable('0000-01-01'))->shouldReturn(null);
        $this->get(new DateTimeImmutable('1950-01-01'))->shouldReturn(null);
        $this->get(new DateTimeImmutable('2000-01-01'))->shouldReturn('Foo');
        $this->get(new DateTimeImmutable('2050-01-01'))->shouldReturn('Foo');
        $this->get(null)->shouldReturn('Foo');

        $this->set('Bar', new DateTimeImmutable('1950-01-01'));
        $this->get(new DateTimeImmutable('0000-01-01'))->shouldReturn(null);
        $this->get(new DateTimeImmutable('1950-01-01'))->shouldReturn('Bar');
        $this->get(new DateTimeImmutable('2000-01-01'))->shouldReturn('Bar');
        $this->get(new DateTimeImmutable('2050-01-01'))->shouldReturn('Bar');
        $this->get(null)->shouldReturn('Bar');

        $this->set('Baz', new DateTimeImmutable('1925-01-01'), new DateTimeImmutable('1975-01-01'));
        $this->get(new DateTimeImmutable('0000-01-01'))->shouldReturn(null);
        $this->get(new DateTimeImmutable('1940-01-01'))->shouldReturn('Baz');
        $this->get(new DateTimeImmutable('1950-01-01'))->shouldReturn('Baz');
        $this->get(new DateTimeImmutable('2000-01-01'))->shouldReturn('Bar');
        $this->get(null)->shouldReturn('Bar');

        $this->set('Qux');
        $this->get(new DateTimeImmutable('0000-01-01'))->shouldReturn('Qux');
        $this->get(new DateTimeImmutable('1940-01-01'))->shouldReturn('Qux');
        $this->get(new DateTimeImmutable('1950-01-01'))->shouldReturn('Qux');
        $this->get(new DateTimeImmutable('2000-01-01'))->shouldReturn('Qux');
        $this->get(null)->shouldReturn('Qux');
    }

    public function it_should_reject_impossible_dates()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSet(
            'foo',
            new DateTimeImmutable('2000-01-01'),
            new DateTimeImmutable('1999-12-31')
        );
    }

    public function it_should_return_all_values()
    {
        $this->set('Bar', new DateTimeImmutable('1950-01-01'));
        $this->set('Foo', new DateTimeImmutable('2000-01-01'));

        $expected = array(
            new TemporalValue('Foo', new DateTime('2000-01-01 00:00:00'), null),
            new TemporalValue('Bar', new DateTime('1950-01-01 00:00:00'), new DateTime('1999-12-31 23:59:59')),
            new TemporalValue(null, null, new DateTime('1949-12-31 23:59:59')),
        );

        $this->all()->shouldBeLike($expected);
    }

    public function it_should_use_array_access()
    {
        $this->offsetExists(null)->shouldReturn(true);
        $this->offsetExists(new DateTimeImmutable('2000-01-01'))->shouldReturn(true);

        $this->offsetGet(new DateTimeImmutable('0000-01-01'))->shouldReturn(null);
        $this->offsetGet(new DateTimeImmutable('1950-01-01'))->shouldReturn(null);
        $this->offsetGet(new DateTimeImmutable('2000-01-01'))->shouldReturn(null);
        $this->offsetGet(new DateTimeImmutable('2050-01-01'))->shouldReturn(null);
        $this->offsetGet(null)->shouldReturn(null);

        $this->offsetSet(new DateTimeImmutable('2000-01-01'), 'Foo');
        $this->offsetGet(new DateTimeImmutable('0000-01-01'))->shouldReturn(null);
        $this->offsetGet(new DateTimeImmutable('1950-01-01'))->shouldReturn(null);
        $this->offsetGet(new DateTimeImmutable('2000-01-01'))->shouldReturn('Foo');
        $this->offsetGet(new DateTimeImmutable('2050-01-01'))->shouldReturn('Foo');
        $this->offsetGet(null)->shouldReturn('Foo');

        $this->offsetSet(new DateTimeImmutable('1950-01-01'), 'Bar');
        $this->offsetGet(new DateTimeImmutable('0000-01-01'))->shouldReturn(null);
        $this->offsetGet(new DateTimeImmutable('1950-01-01'))->shouldReturn('Bar');
        $this->offsetGet(new DateTimeImmutable('2000-01-01'))->shouldReturn('Bar');
        $this->offsetGet(new DateTimeImmutable('2050-01-01'))->shouldReturn('Bar');
        $this->offsetGet(null)->shouldReturn('Bar');

        $this->offsetSet(null, 'Qux');
        $this->offsetGet(new DateTimeImmutable('0000-01-01'))->shouldReturn('Qux');
        $this->offsetGet(new DateTimeImmutable('1950-01-01'))->shouldReturn('Qux');
        $this->offsetGet(new DateTimeImmutable('2000-01-01'))->shouldReturn('Qux');
        $this->offsetGet(new DateTimeImmutable('2050-01-01'))->shouldReturn('Qux');
        $this->offsetGet(null)->shouldReturn('Qux');
    }

    public function it_should_be_countable()
    {
        $this->count()->shouldReturn(1);
        $this->set('Foo', null);
        $this->count()->shouldReturn(1);
        $this->set('Bar', new DateTimeImmutable('1950-01-01'));
        $this->count()->shouldReturn(2);
        $this->set('Bar', new DateTimeImmutable('2000-01-01'));
        $this->count()->shouldReturn(2);
        $this->set('Baz', new DateTimeImmutable('1925-01-01'), new DateTimeImmutable('1975-01-01'));
        $this->count()->shouldReturn(3);
        $this->set('Foo', new DateTimeImmutable('1925-01-01'));
        $this->count()->shouldReturn(1);
    }
}
