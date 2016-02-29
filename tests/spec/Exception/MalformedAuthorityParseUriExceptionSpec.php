<?php

namespace spec\Madkom\Uri\Exception;

use Madkom\Uri\Exception\MalformedAuthorityParseUriException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MalformedAuthorityParseUriExceptionSpec
 * @package spec\Madkom\Uri\Exception
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin MalformedAuthorityParseUriException
 */
class MalformedAuthorityParseUriExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MalformedAuthorityParseUriException::class);
    }
}
