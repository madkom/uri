<?php declare(strict_types=1);

namespace spec\Madkom\Uri;

use Madkom\Uri\Component\Authority;
use Madkom\Uri\Component\Authority\Host;
use Madkom\Uri\Component\Fragment;
use Madkom\Uri\Component\Path;
use Madkom\Uri\Component\Query;
use Madkom\Uri\Scheme\Scheme;
use Madkom\Uri\Uri;
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
    function let(Scheme $scheme, Authority $authority, Path $path, Query $query, Fragment $fragment)
    {
        $scheme->toString()->willReturn('scheme');
        $scheme->canHandleAuthority()->willReturn(true);
        $scheme->canHandlePath()->willReturn(true);
        $scheme->canHandleQuery()->willReturn(true);
        $scheme->canHandleFragment()->willReturn(true);

        $authority->toString()->willReturn('authority');

        $path->toString()->willReturn('/path');

        $query->toString()->willReturn('query=string');
        $query->count()->willReturn(1);

        $fragment->getFragment()->willReturn('fragment');
        $fragment->toString()->willReturn('fragment');

        $this->beConstructedWith($scheme, $authority, $path, $query, $fragment);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Uri::class);
    }

    function it_can_set_and_get_value_host_scheme_and_path(Scheme $scheme, Authority $authority, Path $path, Query $query, Fragment $fragment)
    {
        $this->getScheme()->shouldReturnAnInstanceOf(Scheme::class);
        $this->setScheme($scheme);
        $this->getScheme()->shouldReturn($scheme);

        $this->getAuthority()->shouldReturnAnInstanceOf(Authority::class);
        $this->setAuthority($authority);
        $this->getAuthority()->shouldReturn($authority);

        $this->getPath()->shouldReturnAnInstanceOf(Path::class);
        $this->setPath($path);
        $this->getPath()->shouldReturn($path);

        $this->getQuery()->shouldReturnAnInstanceOf(Query::class);
        $this->setQuery($query);
        $this->getQuery()->shouldReturn($query);

        $this->getFragment()->shouldReturnAnInstanceOf(Fragment::class);
        $this->setFragment($fragment);
        $this->getFragment()->shouldReturn($fragment);
    }
    
    function it_can_get_string_representation()
    {
        $this->toString();
        $this->__toString()->shouldBeString();
    }
}
