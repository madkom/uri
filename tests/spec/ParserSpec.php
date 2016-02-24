<?php

namespace spec\Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Parser;
use Madkom\Uri\Uri;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ParserSpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Parser
 */
class ParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Uri\Parser');
    }

    function it_can_parse_valid_url()
    {
        $this->parse('http://user:pass@madkom.pl/path/to?get=1#fragment')->shouldReturnAnInstanceOf(Uri::class);
    }

    function it_fails_on_scheme_missing()
    {
        $this->shouldThrow(InvalidArgumentException::class)->during('parse', ['//user:pass@madkom.pl/path/to']);
    }
}
