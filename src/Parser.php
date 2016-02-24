<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 13:55
 */
namespace Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Authority\Host\IPv4;
use Madkom\Uri\Authority\Host\IPv6;
use Madkom\Uri\Authority\Host\Name;
use Madkom\Uri\Authority\UserInfo;
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
        $userInfo = $iri->getUserInfo() ? UserInfo::createFromString($iri->getUserInfo()) : null;
        if ($iri->getHost()) {
            if (filter_var($iri->getHost(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                $host = new IPv4($iri->getHost());
            } elseif (0 === strpos($iri->getHost(), '[') &&
                strlen($iri->getHost())-1 === strpos($iri->getHost(), ']') &&
                filter_var($ipString = rtrim(ltrim($iri->getHost(), '['), ']'), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)
            ) {
                $host = new IPv6($ipString);
            } else {
                $host = new Name($iri->getHost());
            }
        } else {
            $host = null;
        }
        if ($iri->getPort()) {
            $port = $iri->getPort();
        } elseif ($scheme instanceof NetworkScheme) {
            $port = $scheme->getPort();
        } else {
            $port = null;
        }
        if (null !== $host) {
            $authority = new Authority($host, $port, $userInfo);
        } else {
            $authority = null;
        }
        $path = Path::createFromString($iri->getPath());
        $query = Query::createFromString($iri->getQuery());
        $fragment = $iri->getFragment();

        return new Uri($scheme, $authority, $path, $query, $fragment);
    }
}
