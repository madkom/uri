<?php declare(strict_types=1);

namespace spec\Madkom\Uri\Component;

use InvalidArgumentException;
use Madkom\Uri\Component\Authority;
use Madkom\Uri\Component\Authority\Host;
use Madkom\Uri\Component\Authority\UserInfo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AuthoritySpec
 * @package spec\Madkom\Uri\Component
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Authority
 */
class AuthoritySpec extends ObjectBehavior
{
    function let(Host $host, UserInfo $userInfo)
    {
        $userInfo->__toString()->willReturn('m.brzuchalski:ala-ma-kota!');
        $host->getAddress()->willReturn('localhost');
        $host->__toString()->willReturn('localhost');
        $this->beConstructedWith($host, 80, $userInfo);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Authority::class);
    }

    function it_can_set_host_port_and_userinfo(Host $host, UserInfo $userInfo)
    {
        $this->setHost($host);
        $this->getHost()->shouldReturn($host);

        $this->setPort(80);
        $this->getPort()->shouldReturn(80);
        $this->shouldThrow(InvalidArgumentException::class)->during('setPort', [80000]);
        $this->shouldThrow(InvalidArgumentException::class)->during('setPort', [-1]);

        $this->setUserInfo($userInfo);
        $this->getUserInfo()->shouldReturn($userInfo);
    }

    function it_can_get_string_representation()
    {
        $this->toString()->shouldReturn('m.brzuchalski:ala-ma-kota!@localhost:80');
        $this->__toString()->shouldReturn('m.brzuchalski:ala-ma-kota!@localhost:80');
    }

    function it_can_be_initialized_without_port(Host $host, UserInfo $userInfo)
    {
        $this->beConstructedWith($host, null, $userInfo);
    }
}
