<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 13:55
 */
namespace Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Component\Fragment;
use Madkom\Uri\Component\Path;
use Madkom\Uri\Parser\Authority as AuthorityParser;
use Madkom\Uri\Parser\Query as QueryParser;
use Madkom\Uri\Scheme\Http;
use Madkom\Uri\Scheme\Https;
use Madkom\Uri\Scheme\Scheme;
use ML\IRI\IRI;

/**
 * Class Parser
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class UriFactory
{
    protected static $schemes = [
        Http::PROTOCOL => Http::class,
        Https::PROTOCOL => Https::class,
    ];

    public function create(string $uriString, Scheme $defaultScheme = null) : Uri
    {
        $scheme = $defaultScheme;
        $iri = new IRI($uriString);
        if ($iri->getScheme()) {
            if (array_key_exists($iri->getScheme(), self::$schemes)) {
                $schemeName = self::$schemes[$iri->getScheme()];
                $scheme = new $schemeName($iri->getScheme());
            }
        }
        if (null === $scheme) {
            throw new InvalidArgumentException("Malformed uri given, missing scheme in: {$uriString}");
        }
        $authorityParser = new AuthorityParser();
        $authority = $authorityParser->parse($iri->getAuthority());

        $path = Path::createFromString($iri->getPath());

        $queryParser = new QueryParser();
        $query = $queryParser->parse((string)$iri->getQuery());
        $fragment = new Fragment($iri->getFragment());

        return new Uri($scheme, $authority, $path, $query, $fragment);
    }
}
