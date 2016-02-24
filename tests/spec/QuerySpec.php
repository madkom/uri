<?php

namespace spec\Madkom\Uri;

use Madkom\Uri\Query\Parameter;
use Madkom\Uri\Query;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use RuntimeException;
use Traversable;

/**
 * Class QuerySpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Query
 */
class QuerySpec extends ObjectBehavior
{
    function let(Parameter $parameter1, Parameter $parameter2, Parameter $parameterUTF)
    {
        $parameter1->getName()->willReturn('param1');
        $parameter1->getValue()->willReturn('a');
        $parameter1->__toString()->willReturn('param1=a');

        $parameter2->getName()->willReturn('param2');
        $parameter2->getValue()->willReturn('b');
        $parameter2->__toString()->willReturn('param2=b');

        $parameterUTF->getName()->willReturn('paramUTF');
        $parameterUTF->getValue()->willReturn(urlencode('ążśźęćłóń'));
        $parameterUTF->__toString()->willReturn('paramUTF=' . urlencode('ążśźęćłóń'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Query::class);
    }

    function it_can_add_new_parameters(Parameter $parameter1, Parameter $parameter2, Parameter $parameterUTF)
    {
        $this->add($parameter1)->shouldReturn(true);
        $this->add($parameter2)->shouldReturn(true);
        $this->add($parameterUTF)->shouldReturn(true);
        $this->shouldThrow(RuntimeException::class)->during('add', [$parameter1]);
        $this->shouldThrow(RuntimeException::class)->during('add', [$parameter2]);
        $this->shouldThrow(RuntimeException::class)->during('add', [$parameterUTF]);
    }

    function it_can_return_QueryString(Parameter $parameter1, Parameter $parameter2, Parameter $parameterUTF)
    {
        $this->add($parameter1)->shouldReturn(true);
        $this->add($parameter2)->shouldReturn(true);
        $this->add($parameterUTF)->shouldReturn(true);
        $this->toString()->shouldReturn('param1=a&param2=b&paramUTF=' . urlencode('ążśźęćłóń'));
        $this->__toString()->shouldReturn('param1=a&param2=b&paramUTF=' . urlencode('ążśźęćłóń'));
    }

    function it_can_operate_on_params(Parameter $parameter1, Parameter $parameter2, Parameter $parameterUTF)
    {
        $this->add($parameter1)->shouldReturn(true);
        $this->add($parameter2)->shouldReturn(true);
        $this->add($parameterUTF)->shouldReturn(true);

        $iterator = $this->getIterator();
        $iterator->shouldReturnAnInstanceOf(Traversable::class);

        foreach ($iterator as $param) {
            $param->shouldReturnAnInstanceOf(Parameter::class);
        }

        $this->contains($parameter1)->shouldReturn(true);
        $this->contains($parameter2)->shouldReturn(true);
        $this->contains($parameterUTF)->shouldReturn(true);

        $this->remove($parameter1)->shouldReturn(true);
        $this->remove($parameter2)->shouldReturn(true);
        $this->remove($parameterUTF)->shouldReturn(true);

        $this->contains($parameter1)->shouldReturn(false);
        $this->contains($parameter2)->shouldReturn(false);
        $this->contains($parameterUTF)->shouldReturn(false);
    }
}
