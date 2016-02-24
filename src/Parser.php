<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 13:55
 */
namespace Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Parser\Authority as AuthorityParser;
use Madkom\Uri\Parser\Query as QueryParser;
use Madkom\Uri\Scheme\Custom;
use Madkom\Uri\Scheme\Http;
use Madkom\Uri\Scheme\Https;
use ML\IRI\IRI;

/**
 * Class Parser
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Parser
{
    protected static $schemes = [
        Http::PROTOCOL => Http::class,
        Https::PROTOCOL => Https::class,
    ];

    public function parse(string $uriString) : Uri
    {
        $iri = new IRI($uriString);
        if ($iri->getScheme()) {
            if (array_key_exists($iri->getScheme(), self::$schemes)) {
                $schemeName = self::$schemes[$iri->getScheme()];
                $scheme = new $schemeName($iri->getScheme());
            } else {
                $scheme = new Custom($iri->getScheme());
            }
        } else {
            throw new InvalidArgumentException("Malformed uri given, missing scheme in: {$uriString}");
        }
        $authorityParser = new AuthorityParser();
        $authority = $authorityParser->parse($iri->getAuthority());

        $path = Path::createFromString($iri->getPath());

        $queryParser = new QueryParser();
        $query = $queryParser->parse($iri->getQuery());
        $fragment = $iri->getFragment();

        return new Uri($scheme, $authority, $path, $query, $fragment);
    }
}
