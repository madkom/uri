<?php

namespace spec\Madkom\Uri\Scheme;

use Madkom\Uri\Scheme\Http;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class HttpSpec
 * @package spec\Madkom\Uri\Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Http
 */
class HttpSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Http::class);
    }

    function it_can_get_scheme_and_port()
    {
        $this->getScheme()->shouldReturn('http');
        $this->getPort()->shouldReturn(80);
    }
}
