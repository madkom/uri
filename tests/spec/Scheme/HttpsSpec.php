<?php declare(strict_types=1);

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
}
