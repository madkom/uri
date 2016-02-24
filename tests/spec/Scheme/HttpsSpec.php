<?php

namespace spec\Madkom\Uri\Scheme;

use Madkom\Uri\Scheme\Https;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class HttpsSpec
 * @package spec\Madkom\Uri\Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Https
 */
class HttpsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Https::class);
    }

    function it_can_get_scheme_and_port()
    {
        $this->getScheme()->shouldReturn('https');
        $this->getPort()->shouldReturn(443);
    }
}
