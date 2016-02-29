<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.02.16
 * Time: 13:16
 */
namespace Madkom\Uri;

use Madkom\Uri\Component\Authority;
use Madkom\Uri\Component\Fragment;
use Madkom\Uri\Component\Path;
use Madkom\Uri\Component\Query;
use Madkom\Uri\Scheme\Scheme;

/**
 * Class UriReference
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class UriReference extends Uri
{
    /**
     * UriReference constructor.
     * @param Scheme|null $scheme
     * @param Authority|null $authority
     * @param Path|null $path
     * @param Query|null $query
     * @param Fragment|null $fragment
     */
    public function __construct(Scheme $scheme = null, Authority $authority = null, Path $path = null, Query $query = null, Fragment $fragment = null)
    {
        $this->scheme = $scheme;
        $this->authority = $authority;
        $this->path = $path ?? new Path();
        $this->query = $query ?? new Query();
        $this->fragment = $fragment ?? new Fragment();
    }

    /**
     * Transforms UriReference into Uri according to RFC 3986 at 5.2.2. Transform References
     * @url https://tools.ietf.org/html/rfc3986#section-5.2.2
     * @param Uri $baseUri
     * @return Uri
     */
    public function resolveUri(Uri $baseUri) : Uri
    {
        if (null !== $this->scheme) {
            $result = new Uri($this->scheme);
            $result->setAuthority($this->authority);
            $result->setPath($this->path->removeDotSegments());
            $result->setQuery($this->query);
        } else {
            $result = new Uri($baseUri->scheme);
            if (null !== $this->authority) {
                $result->setAuthority($this->authority);
                $result->setPath($this->path->removeDotSegments());
                $result->setQuery($this->query);
            } else {
                $result->setAuthority($baseUri->authority);
                if ($this->path->toString() == "") {
                    $result->setPath($baseUri->path);
                    if (count($this->query) > 0) {
                        $result->setQuery($this->query);
                    } else {
                        $result->setQuery($baseUri->query);
                    }
                } else {
                    if ($this->path->isAbsolute()) {
                        $result->setPath($this->path->removeDotSegments());
                    } else {
                        $result->setPath($baseUri->path->merge($this->path)->removeDotSegments());
                    }
                    $result->setQuery($this->query);
                }
            }
        }
        $result->setFragment($this->fragment);

        return $result;
    }

    public function toString(int $flags = 0) : string
    {
        $result = '';
        if ($this->scheme) {
            $result .= $this->scheme->toString() . ":";
        }
        if ((null === $this->scheme || $this->scheme->canHandleAuthority()) && (null !== $this->authority)) {
            $result .= "//" . $this->authority->toString();
        }
        if ((null === $this->scheme || $this->scheme->canHandlePath())) {
            $result .= $this->path->toString();
        }
        if ((null === $this->scheme || $this->scheme->canHandleQuery()) && count($this->query) > 0) {
            $result .= "?" . $this->query->toString();
        }
        if ((null === $this->scheme || $this->scheme->canHandleFragment()) && !empty($this->fragment->getFragment())) {
            $result .= "#" . $this->fragment->toString();
        }

        return (string)$result;
    }
}
