<?php declare(strict_types=1);

namespace spec\Madkom\Uri\Component\Query;

use Madkom\Uri\Component\Query\Parameter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ParameterSpec
 * @package spec\Madkom\Uri\Component
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Parameter
 */
class ParameterSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Parameter::class);
    }

    function it_can_get_name_and_value()
    {
        $name = 'name';
        $value = ['a' => 1];
        $this->beConstructedWith($name, $value);
        $this->getName()->shouldReturn($name);
        $this->getValue()->shouldReturn($value);
        $this->toString()->shouldReturn('name%5Ba%5D=1');
        $this->__toString()->shouldReturn('name%5Ba%5D=1');
    }
    function it_can_get_name_and_null_value()
    {
        $name = 'name';
        $this->beConstructedWith($name);
        $this->getName()->shouldReturn($name);
        $this->getValue()->shouldReturn(null);
        $this->toString()->shouldReturn('');
        $this->__toString()->shouldReturn('');
    }

    function it_can_return_string_representation_with_value()
    {
        $this->beConstructedWith('name', 'value');
        $this->toString()->shouldReturn('name=value');
    }

    function it_can_return_string_representation_with_urlencoded_value()
    {
        $value = "ąśźęćłóń";
        $this->beConstructedWith('name', $value);
        $this->toString()->shouldReturn('name=' . urlencode($value));
    }
}
