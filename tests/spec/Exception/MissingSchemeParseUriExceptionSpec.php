<?php

namespace spec\Madkom\Uri\Exception;

use Madkom\Uri\Exception\MissingSchemeParseUriException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MissingSchemeParseUriExceptionSpec
 * @package spec\Madkom\Uri\Exception
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin MissingSchemeParseUriException
 */
class MissingSchemeParseUriExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MissingSchemeParseUriException::class);
    }
}
