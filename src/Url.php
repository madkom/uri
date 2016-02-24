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
    public function __construct(string $uri)
    {
        $this->parse($uri);
        if (!($this->scheme instanceof NetworkScheme)) {
            $this->scheme = new Http();
        }
        if (!$this->port) {
            $this->port = $this->scheme->getPort();
        }
    }

    /**
     * @param Uri $uri
     * @return Url
     */
    public static function createFromURI(Uri $uri)
    {
        if ($uri->scheme instanceof Scheme &&
            !($uri->scheme instanceof NetworkScheme) &&
            !($uri->authority instanceof Authority)
        ) {
            throw new InvalidArgumentException(
                "Unable to convert URI({$uri->scheme->getScheme()}) to URL, missing authority or invalid scheme"
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
