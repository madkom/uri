<?php declare(strict_types=1);

namespace spec\Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Exception\MissingSchemeParseUriException;
use Madkom\Uri\UriFactory;
use Madkom\Uri\Uri;
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

    function it_can_parse_valid_url()
    {
        $this->createUri('http://user:pass@madkom.pl/path/to?get=1#fragment')->shouldReturnAnInstanceOf(Uri::class);
    }

    function it_fails_on_scheme_missing()
    {
        $this->shouldThrow(MissingSchemeParseUriException::class)->during('createUri', ['//user:pass@madkom.pl/path/to']);
    }
}
