<?php declare(strict_types=1);

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
}
