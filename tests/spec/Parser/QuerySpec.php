<?php declare(strict_types=1);

namespace spec\Madkom\Uri\Parser;

use Madkom\Uri\Parser\Query;
use Madkom\Uri\Component\Query as QueryComponent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use UnexpectedValueException;

/**
 * Class QuerySpec
 * @package spec\Madkom\Uri\Parser
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Query
 */
class QuerySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Query::class);
    }
    
    function it_can_add_parameters()
    {
        $query = $this->parse('a=1&b=2&c=3');
        $query->shouldReturnAnInstanceOf(QueryComponent::class);
        $query->count()->shouldReturn(3);
        $query->exists(function (QueryComponent\Parameter $parameter) {
            return $parameter->getName() == 'a';
        })->shouldReturn(true);
        $query->exists(function (QueryComponent\Parameter $parameter) {
            return $parameter->getName() == 'b';
        })->shouldReturn(true);
        $query->exists(function (QueryComponent\Parameter $parameter) {
            return $parameter->getName() == 'c';
        })->shouldReturn(true);
    }

    function it_fails_on_unsupported_parsing_mode()
    {
        $this->shouldThrow(UnexpectedValueException::class)->during('parse', ['', 2]);
        $this->shouldThrow(UnexpectedValueException::class)->during('parse', ['', 0]);
    }
}
