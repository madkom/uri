<?php declare(strict_types=1);

namespace spec\Madkom\Uri\Component\Authority;

use InvalidArgumentException;
use Madkom\Uri\Component\Authority\UserInfo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UserInfoSpec
 * @package spec\Madkom\Uri\Component\Authority
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin UserInfo
 */
class UserInfoSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('m.brzuchalski', 'ala-ma-kota!');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UserInfo::class);
    }

    function it_can_retrieve_username_and_passwrod()
    {
        $this->setUsername('m.brzuchalski');
        $this->getUsername()->shouldReturn('m.brzuchalski');
        $this->setPassword('ala-ma-kota!');
        $this->getPassword()->shouldReturn('ala-ma-kota!');

        $this->toString()->shouldReturn('m.brzuchalski:ala-ma-kota!');
        $this->__toString()->shouldReturn('m.brzuchalski:ala-ma-kota!');
    }

    function it_fails_on_invalid_username_or_password()
    {
        $this->shouldThrow(InvalidArgumentException::class)->during('setUsername', ['m brzuchalski']);
        $this->shouldThrow(InvalidArgumentException::class)->during('setUsername', ['m@brzuchalski']);
        $this->shouldThrow(InvalidArgumentException::class)->during('setUsername', ['m:brzuchalski']);
        $this->shouldThrow(InvalidArgumentException::class)->during('setUsername', ['m/brzuchalski']);
        $this->shouldThrow(InvalidArgumentException::class)->during('setPassword', ['ala ma kota!']);
        $this->shouldThrow(InvalidArgumentException::class)->during('setPassword', ['ala@kota!']);
        $this->shouldThrow(InvalidArgumentException::class)->during('setPassword', ['ala:kota!']);
        $this->shouldThrow(InvalidArgumentException::class)->during('setPassword', ['ala/kota!']);
    }
}
