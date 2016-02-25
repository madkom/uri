<?php declare(strict_types=1);

namespace spec\Madkom\Uri\Parser;

use InvalidArgumentException;
use Madkom\Uri\Component\Authority as AuthorityComponent;
use Madkom\Uri\Component\Authority\Host\IPv4;
use Madkom\Uri\Component\Authority\Host\IPv6;
use Madkom\Uri\Component\Authority\Host\Name;
use Madkom\Uri\Component\Authority\UserInfo;
use Madkom\Uri\Parser\Authority;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AuthoritySpec
 * @package spec\Madkom\Uri\Parser
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Authority
 */
class AuthoritySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Authority::class);
    }

    function it_can_parse_various_authority_strings()
    {
        $withHostname = $this->parse('m.brzuchalski:ala-ma-kota!@madkom.pl');
        $withHostname->shouldReturnAnInstanceOf(AuthorityComponent::class);
        $withHostname->getHost()->shouldReturnAnInstanceOf(Name::class);
        $withHostname->getPort()->shouldReturn(null);
        $withHostname->getUserInfo()->shouldReturnAnInstanceOf(UserInfo::class);
        $withHostname->getUserInfo()->getUsername()->shouldReturn('m.brzuchalski');
        $withHostname->getUserInfo()->getPassword()->shouldReturn('ala-ma-kota!');

        $withIPv4 = $this->parse('m.brzuchalski:ala-ma-kota!@254.127.17.1:9999');
        $withIPv4->shouldReturnAnInstanceOf(AuthorityComponent::class);
        $withIPv4->getHost()->shouldReturnAnInstanceOf(IPv4::class);
        $withIPv4->getPort()->shouldReturn(9999);
        $withIPv4->getUserInfo()->shouldReturnAnInstanceOf(UserInfo::class);
        $withIPv4->getUserInfo()->getUsername()->shouldReturn('m.brzuchalski');
        $withIPv4->getUserInfo()->getPassword()->shouldReturn('ala-ma-kota!');

        $withIPv6 = $this->parse('m.brzuchalski:ala-ma-kota!@[::1]:9999');
        $withIPv6->shouldReturnAnInstanceOf(AuthorityComponent::class);
        $withIPv6->getHost()->shouldReturnAnInstanceOf(IPv6::class);
        $withIPv6->getPort()->shouldReturn(9999);
        $withIPv6->getUserInfo()->shouldReturnAnInstanceOf(UserInfo::class);
        $withIPv6->getUserInfo()->getUsername()->shouldReturn('m.brzuchalski');
        $withIPv6->getUserInfo()->getPassword()->shouldReturn('ala-ma-kota!');
    }
    
    function it_fails_on_invalid_authority_strings()
    {
        $this->shouldThrow(InvalidArgumentException::class)->during('parse', ['m brzuchalski@madkom.pl']);
        $this->shouldThrow(InvalidArgumentException::class)->during('parse', ['m.br@#zuchalski@madkom.pl']);
        $this->shouldThrow(InvalidArgumentException::class)->during('parse', ['m.brzuchalski:ala ma kota!@madkom.pl']);
        $this->shouldThrow(InvalidArgumentException::class)->during('parse', ['m.brzuchalski:ala-ma-kota!@madkom pl']);
        $this->shouldThrow(InvalidArgumentException::class)->during('parse', ['m.brzuchalski:ala-ma-kota!@madkom..pl']);
    }
}
