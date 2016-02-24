<?php

namespace spec\Madkom\Uri\Query;

use Madkom\Uri\Query\Parameter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ParameterSpec
 * @package spec\Madkom\Uri
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
    }
    function it_can_get_name_and_null_value()
    {
        $name = 'name';
        $this->beConstructedWith($name);
        $this->getName()->shouldReturn($name);
        $this->getValue()->shouldReturn(null);
    }

    function it_can_return_string_representation_with_empty_value()
    {
        $this->toString()->shouldReturn('name=');
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
