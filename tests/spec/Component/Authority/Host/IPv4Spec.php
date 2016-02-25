<?php declare(strict_types=1);

namespace spec\Madkom\Uri\Component\Authority\Host;

use InvalidArgumentException;
use Madkom\Uri\Component\Authority\Host\IPv4;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class IPv4Spec
 * @package spec\Madkom\Uri\Component\Authority\Host
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin IPv4
 */
class IPv4Spec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('127.0.0.1');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IPv4::class);
    }

    function it_can_retrieve_valid_address()
    {
        $this->getAddress()->shouldBeString();
        $this->toString()->shouldReturn('127.0.0.1');
        $this->__toString()->shouldReturn('127.0.0.1');
    }

    function it_fails_on_invalid_address_instantiation()
    {
        $this->shouldThrow(InvalidArgumentException::class)->during('__construct', ['']);
        $this->shouldThrow(InvalidArgumentException::class)->during('__construct', [':::1']);
        $this->shouldThrow(InvalidArgumentException::class)->during('__construct', ['::abhg']);
        $this->shouldThrow(InvalidArgumentException::class)->during('__construct', ['256.0.0.1']);
        $this->shouldThrow(InvalidArgumentException::class)->during('__construct', ['127.0.0.1.0.5']);
    }

}
