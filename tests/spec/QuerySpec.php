<?php

namespace spec\Madkom\Uri;

use Madkom\Uri\Query\Parameter;
use Madkom\Uri\Query;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use RuntimeException;

/**
 * Class QuerySpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Query
 */
class QuerySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Query::class);
    }

    function it_can_add_new_parameters()
    {
        $param1 = new Parameter('param1');
        $param2 = new Parameter('param2');
        $this->add($param1)->shouldreturn(true);
        $this->add($param2)->shouldreturn(true);
        $this->shouldThrow(RuntimeException::class)->during('add', [$param2]);
    }

    function it_can_return_QueryString()
    {
        $param1 = new Parameter('param1', 'a');
        $param2 = new Parameter('param2', 'b');
        $paramUTF = new Parameter('paramUTF', 'ążśźęćłóń');

        $this->add($param1)->shouldreturn(true);
        $this->add($param2)->shouldreturn(true);
        $this->add($paramUTF)->shouldreturn(true);
        $this->toString()->shouldReturn('?param1=a&param2=b&paramUTF=' . urlencode('ążśźęćłóń'));
    }
}
