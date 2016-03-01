<?php declare(strict_types=1);

namespace spec\Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Exception\MalformedAuthorityParseUriException;
use Madkom\Uri\Exception\MissingSchemeParseUriException;
use Madkom\Uri\Exception\ParseUriException;
use Madkom\Uri\UriFactory;
use Madkom\Uri\Uri;
use Madkom\Uri\UriReference;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ParserSpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin UriFactory
 */
class UriFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UriFactory::class);
    }

    function it_can_create_Uri_and_UriReference()
    {
        $this->createUri('http://127.0.0.1:88')->shouldReturnAnInstanceOf(Uri::class);
        $this->createUri('http://[::1]:88')->shouldReturnAnInstanceOf(Uri::class);
        $this->setMode(1);
        $this->createUri('http://user:pass@madkom.pl/path/to?get=1&get=2&get[]=3&b[]=8&b=9#fragment')->shouldReturnAnInstanceOf(Uri::class);
        $this->setMode(2);
        $this->createUri('http://user:pass@madkom.pl/path/to?get=1&get=2&get[]=3&get[4]=5&b[]=8&b=9#fragment')->shouldReturnAnInstanceOf(Uri::class);
        $this->createUriReference('/path/to?get=1#fragment')->shouldReturnAnInstanceOf(Uri::class);
        $this->createUriReference('http://user:pass@madkom.pl/path/to?get=1#fragment')->shouldReturnAnInstanceOf(Uri::class);
    }

    function it_fails_on_malformed_Uri()
    {
        $this->shouldThrow(MissingSchemeParseUriException::class)->during('createUri', ['//user:pass@madkom.pl/path/to']);
        $this->shouldThrow(MissingSchemeParseUriException::class)->during('createUri', ['unknown://user:pass@madkom.pl/path/to']);
        $this->shouldThrow(ParseUriException::class)->during('createUri', ['ala.ma.kota# #:2:1:3# ?/?ble?ddd']);
        $this->shouldThrow(ParseUriException::class)->during('createUriReference', ['ala.ma.kota# #:2:1:3# ?/?ble?ddd']);
        $this->shouldThrow(MalformedAuthorityParseUriException::class)->during('createUri', ['http://malformed@/']);
    }

    function it_can_parse_valid_UriReference_and_resolve_with_Uri()
    {
        $uriReference = $this->createUriReference('.././some/new/path?and=query');
        $uriReference->shouldReturnAnInstanceOf(UriReference::class);

        $uri = $this->createUri('http://some.host/and/path?old=query#and-fragment');
        $uri->shouldReturnAnInstanceOf(Uri::class);

        $resolvedUriReference = $uriReference->resolveUri($uri);
        $resolvedUriReference->shouldReturnAnInstanceOf(Uri::class);

        $uriReference->toString()->shouldReturn('.././some/new/path?and=query');
        $uri->toString()->shouldReturn('http://some.host/and/path?old=query#and-fragment');
        $resolvedUriReference->toString()->shouldReturn('http://some.host/and/some/new/path?and=query');
    }
}
