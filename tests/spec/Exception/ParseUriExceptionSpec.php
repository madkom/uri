<?php

namespace spec\Madkom\Uri\Exception;

use Madkom\Uri\Exception\ParseUriException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ParseUriExceptionSpec
 * @package spec\Madkom\Uri\Exception
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin ParseUriException
 */
class ParseUriExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ParseUriException::class);
    }
}
