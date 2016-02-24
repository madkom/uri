<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 11.02.16
 * Time: 15:08
 */
namespace Madkom\Uri;

use InvalidArgumentException;
use Madkom\Uri\Authority\Host;
use Madkom\Uri\Authority\Host\Name;
use Madkom\Uri\Authority\Host\IPv4;
use Madkom\Uri\Authority\Host\IPv6;
use Madkom\Uri\Authority\UserInfo;
use Madkom\Uri\Scheme\Http;
use Madkom\Uri\Scheme\Https;
use Madkom\Uri\Scheme\Custom;
use ML\IRI\IRI;

/**
 * Class Uri
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Uri
{
    /**
     * @var Scheme|null Holds scheme component
     */
    protected $scheme = null;
    /**
     * @var Authority Holds authority component
     */
    protected $authority = null;
    /**
     * @var Path Holds path component
     */
    protected $path;
    /**
     * @var Query Holds query component
     */
    protected $query = null;
    /**
     * @var string|null Holds fragment component
     */
    protected $fragment = null;

    /**
     * Uri constructor.
     * @param Scheme $scheme
     * @param Authority $authority
     * @param Path $path
     * @param Query $query
     */
    public function __construct(Scheme $scheme, Authority $authority, Path $path, Query $query = null)
    {
        $this->scheme = $scheme;
        $this->authority = $authority;
        $this->path = $path;
        $this->query = $query;
    }

    /**
     * Retrieve scheme protocol
     * @return Scheme
     */
    public function getScheme() : Scheme
    {
        return $this->scheme;
    }

    /**
     * Sets scheme
     * @param Scheme $scheme
     */
    public function setScheme(Scheme $scheme)
    {
        $this->scheme = $scheme;
    }

    /**
     * Retrieve authority
     * @return Authority
     */
    public function getAuthority() : Authority
    {
        return $this->authority;
    }

    /**
     * Sets authority
     * @param Authority $authority
     */
    public function setAuthority(Authority $authority)
    {
        $this->authority = $authority;
    }

    /**
     * Retrieve query component
     * @return Query
     */
    public function getQuery() : Query
    {
        return $this->query;
    }

    /**
     * Sets query component
     * @param Query $query
     */
    public function setQuery(Query $query)
    {
        $this->query = $query;
    }

    /**
     * Retrieve path info
     * @return Path
     */
    public function getPath() : Path
    {
        return $this->path;
    }

    /**
     * Sets path component
     * @param Path $path
     */
    public function setPath(Path $path)
    {
        $this->path = $path;
    }

    /**
     * Retrieve url from uri
     * @return Url
     */
    public function getUrl() : Url
    {
        return Url::createFromURI($this);
    }

    /**
     * Retrieve uri string representation
     * @return string
     */
    public function toString() : string
    {
        return '';
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
