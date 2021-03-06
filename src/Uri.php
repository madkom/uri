<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 11.02.16
 * Time: 15:08
 */
namespace Madkom\Uri;

use Madkom\Uri\Component\Authority;
use Madkom\Uri\Component\Authority\Host;
use Madkom\Uri\Component\Fragment;
use Madkom\Uri\Component\Path;
use Madkom\Uri\Component\Query;
use Madkom\Uri\Scheme\Scheme;

/**
 * Class Uri
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Uri
{
    /**
     * @var Scheme Holds scheme component
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
    protected $query;
    /**
     * @var Fragment Holds fragment component
     */
    protected $fragment;

    /**
     * Uri constructor.
     * @param Scheme $scheme
     * @param Authority $authority
     * @param Path $path
     * @param Query $query
     * @param Fragment $fragment
     */
    public function __construct(
        Scheme $scheme,
        Authority $authority = null,
        Path $path = null,
        Query $query = null,
        Fragment $fragment = null
    ) {
        $this->scheme = $scheme;
        $this->authority = $authority;
        $this->path = $path ?? new Path();
        $this->query = $query ?? new Query();
        $this->fragment = $fragment ?? new Fragment();
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
     * Retrieves fragment component
     * @return Fragment
     */
    public function getFragment() : Fragment
    {
        return $this->fragment;
    }

    /**
     * Sets fragment component
     * @param Fragment $fragment
     */
    public function setFragment(Fragment $fragment)
    {
        $this->fragment = $fragment;
    }

    /**
     * Retrieve uri string representation according to RFC 3986 at 5.3. Component Recomposition
     * @url https://tools.ietf.org/html/rfc3986#section-5.3
     * @param int $flags String conversion flags
     * @return string
     */
    public function toString(int $flags = 0) : string
    {
        $result = '';
        if ($this->scheme) {
            $result .= $this->scheme->toString() . ":";
        }
        if ($this->scheme->canHandleAuthority() && (null !== $this->authority)) {
            $result .= "//" . $this->authority->toString();
        }
        if ($this->scheme->canHandlePath()) {
            $result .= $this->path->toString();
        }
        if ($this->scheme->canHandleQuery() && count($this->query) > 0) {
            $result .= "?" . $this->query->toString();
        }
        if ($this->scheme->canHandleFragment() && !empty($this->fragment->getFragment())) {
            $result .= "#" . $this->fragment->toString();
        }

        return (string)$result;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
