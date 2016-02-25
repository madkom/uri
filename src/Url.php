<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 13:52
 */
namespace Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Scheme\Http;
use ReflectionClass;

/**
 * Class URL
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Url extends Uri
{
    /**
     * @param Uri $uri
     * @return Url
     */
    public static function createFromURI(Uri $uri)
    {
        if ($uri->getScheme() instanceof Scheme &&
            (!($uri->getScheme() instanceof NetworkScheme) || !($uri->getAuthority() instanceof Authority))
        ) {
            throw new InvalidArgumentException(
                "Unable to convert URI({$uri->getScheme()->getScheme()}) to URL, missing authority or invalid scheme"
            );
        }
        $reflection = new ReflectionClass(self::class);
        /** @var Url $url */
        $url = $reflection->newInstanceWithoutConstructor();
        $url->scheme = $uri->scheme ?? new Http();
        $url->authority = $uri->authority;
        $url->path = $uri->path;
        $url->query = $uri->query;
        $url->fragment = $uri->fragment;

        return $url;
    }
}
