<?php

namespace spec\Madkom\Uri;

use Madkom\Uri\Authority;
use Madkom\Uri\Authority\Host;
use Madkom\Uri\Authority\UserInfo;
use Madkom\Uri\Authority\Host\Name;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AuthoritySpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Authority
 */
class AuthoritySpec extends ObjectBehavior
{
    function let(Host $host, UserInfo $userInfo)
    {
        $userInfo->__toString()->willReturn('m.brzuchalski:ala-ma-kota!');
        $this->beConstructedWith(new Name('localhost'), 80, $userInfo);
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
        $this->setUserInfo($userInfo);
        $this->getUserInfo()->shouldReturn($userInfo);
    }

    function it_can_get_string_representation()
    {
//        $userInfo->beConstructedWith(['m.brzuchalski', 'ala-ma-kota!']);
        $this->toString()->shouldReturn('m.brzuchalski:ala-ma-kota!@localhost:80');
    }
}
