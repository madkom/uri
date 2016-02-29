<?php declare(strict_types=1);

namespace spec\Madkom\Uri;

use Madkom\Uri\Component\Authority;
use Madkom\Uri\Component\Authority\Host;
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
    function let(Scheme $scheme, Authority $authority, Path $path, Query $query)
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
    
    function it_can_get_string_representation()
    {
        $this->toString();
        $this->__toString()->shouldBeString();
    }
}
