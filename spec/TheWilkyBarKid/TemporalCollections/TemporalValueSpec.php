<?php

namespace spec\TheWilkyBarKid\TemporalCollections;

use DateTime;
use PhpSpec\ObjectBehavior;

/**
 * Temporal value spec.
 *
 * @author Chris Wilkinson <chriswilkinson84@gmail.com>
 */
class TemporalValueSpec extends ObjectBehavior
{
    private $value = 'foo';

    public function let()
    {
        $this->beConstructedWith($this->value);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('TheWilkyBarKid\TemporalCollections\TemporalValue');
    }

    public function it_should_have_a_value()
    {
        $this->getValue()->shouldReturn($this->value);
    }

    public function it_may_have_a_null_effective_from_date()
    {
        $this->getEffectiveFrom()->shouldReturn(null);
    }

    public function it_may_have_an_effective_from_date()
    {
        $from = new DateTime();

        $this->beConstructedWith($this->value, $from);

        $this->getEffectiveFrom()->shouldBeLike($from);
    }

    public function it_may_have_a_null_effective_to_date()
    {
        $this->getEffectiveTo()->shouldReturn(null);
    }

    public function it_may_have_an_effective_to_date()
    {
        $to = new DateTime();

        $this->beConstructedWith($this->value, null, $to);

        $this->getEffectiveTo()->shouldBeLike($to);
    }
}
