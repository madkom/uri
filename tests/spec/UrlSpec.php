<?php

namespace spec\Madkom\Uri;

use Madkom\Uri\Authority;
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
    function let(Scheme $scheme, Authority $authority, Path $path, Query $query, Uri $uri)
    {
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
}
