<?php

namespace spec\Madkom\Uri;

use Madkom\Uri\UriReference;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UriReferenceSpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin UriReference
 */
class UriReferenceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UriReference::class);
    }
}
