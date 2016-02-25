<?php

namespace spec\Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Authority;
use Madkom\Uri\NetworkScheme;
use Madkom\Uri\Path;
use Madkom\Uri\Query;
use Madkom\Uri\Scheme;
use Madkom\Uri\Uri;
use Madkom\Uri\Url;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UrlSpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Url
 */
class UrlSpec extends ObjectBehavior
{
    function let(NetworkScheme $scheme, Authority $authority, Path $path, Query $query, Uri $uri)
    {
        $scheme->getScheme()->willReturn('http');
        $uri->getScheme()->willReturn($scheme);
        $uri->getAuthority()->willReturn($authority);
        $uri->getPath()->willReturn($path);
        $uri->getQuery()->willReturn($query);
        $this->beConstructedWith($scheme, $authority, $path, $query);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Url::class);
    }

    function it_can_be_created_from_Uri(Uri $uri)
    {
        $this::createFromURI($uri)->shouldReturnAnInstanceOf(Url::class);
    }

    function it_fails_on_non_network_scheme_creation_from_Uri(Uri $uri)
    {
        $uri->getScheme()->willReturn(new Scheme\Custom('isbn'));
        $this->shouldThrow(InvalidArgumentException::class)->during('createFromURI', [$uri]);
    }
}
