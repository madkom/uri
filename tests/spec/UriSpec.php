<?php

namespace spec\Madkom\Uri;

use Madkom\Uri\Authority;
use Madkom\Uri\Authority\Host;
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
 * @mixin Uri
 */
class UriSpec extends ObjectBehavior
{
    function let(Scheme $scheme, NetworkScheme $networkScheme, Authority $authority, Path $path, Query $query)
    {
        $networkScheme->getScheme()->willReturn('http');
        $this->beConstructedWith($scheme, $authority, $path, $query);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Uri::class);
    }

    function it_can_set_and_get_value_host_scheme_and_path(Scheme $scheme, Authority $authority, Path $path, Query $query)
    {
        $this->getScheme()->shouldReturnAnInstanceOf(Scheme::class);
        $this->getAuthority()->shouldReturnAnInstanceOf(Authority::class);

        $this->getQuery()->shouldReturnAnInstanceOf(Query::class);
        $this->getPath()->shouldReturnAnInstanceOf(Path::class);

        $this->setScheme($scheme);
        $this->getScheme()->shouldReturn($scheme);

        $this->setAuthority($authority);
        $this->getAuthority()->shouldReturn($authority);

        $this->setPath($path);
        $this->getPath()->shouldReturn($path);

        $this->setQuery($query);
        $this->getQuery()->shouldReturn($query);
    }

    function it_can_get_Url(NetworkScheme $networkScheme)
    {
        $this->setScheme($networkScheme);
        $this->getUrl()->shouldReturnAnInstanceOf(Url::class);
    }

    function it_can_get_string_representation()
    {
        $this->toString()->shouldBeString();
        $this->__toString()->shouldBeString();
    }
}
