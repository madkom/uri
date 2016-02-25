<?php declare(strict_types=1);

namespace spec\Madkom\Uri\Component;

use Madkom\Uri\Component\Fragment;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class FragmentSpec
 * @package spec\Madkom\Uri\Component
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Fragment
 */
class FragmentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Fragment::class);
    }

    function it_can_get_and_set_fragment()
    {
        $this->setFragment('ala-ma-kota');
        $this->getFragment()->shouldReturn('ala-ma-kota');
    }

    function it_can_retrieve_string_representation()
    {
        $this->toString()->shouldBeString();
        $this->__toString()->shouldBeString();
    }
}
