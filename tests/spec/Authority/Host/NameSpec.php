<?php

namespace spec\Madkom\Uri\Authority\Host;

use Madkom\Uri\Authority\Host\Name;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class NameSpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Name
 */
class NameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('madkom.pl');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Name::class);
    }

    function it_retrieves_hostname_in_ascii_and_unicode_format()
    {
        $name = 'zażółć-gęślą-jaźń.pl';
        $this->beConstructedWith($name);
        $this->getAddress()->shouldReturn('xn--za-gl-ja-w3a7psa2tqtgb10airva.pl');
        $this->getUnicode()->shouldReturn($name);
        $this->toString()->shouldReturn('xn--za-gl-ja-w3a7psa2tqtgb10airva.pl');
        $this->__toString()->shouldReturn('xn--za-gl-ja-w3a7psa2tqtgb10airva.pl');
    }

    function it_fails_on_invalid_address_instantiation()
    {
        $this->shouldThrow(InvalidArgumentException::class)->during('__construct', ['']);
        $this->shouldThrow(InvalidArgumentException::class)->during('__construct', ['host:invalid']);
    }
}
