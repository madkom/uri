<?php

namespace spec\Madkom\Uri\Scheme;

use Madkom\Uri\Scheme\Custom;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CustomSpec
 * @package spec\Madkom\Uri\Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Custom
 */
class CustomSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('custom');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Custom::class);
    }

    function it_can_get_given_scheme()
    {
        $this->getScheme()->shouldReturn('custom');
    }
}
