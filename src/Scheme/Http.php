<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 14:00
 */
namespace Madkom\Uri\Scheme;

use Madkom\Uri\Component\Authority;
use Madkom\Uri\Component\Fragment;
use Madkom\Uri\Component\Path;
use Madkom\Uri\Component\Query;
use Madkom\Uri\Uri;

/**
 * Class Http
 * @package Madkom\Uri\Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Http implements Scheme
{
    const PROTOCOL = 'http';
    /**
     * Compose uri from parsed components
     * @param Authority $authority
     * @param Path $path
     * @param Query $query
     * @param Fragment $fragment
     * @return Uri
     */
    public function compose(Authority $authority, Path $path, Query $query, Fragment $fragment) : Uri
    {
        return new Uri($this, $authority, $path, $query, $fragment);
    }

    /**
     * Retrieve uri string representation
     * @param Uri $uri
     * @param int $flags
     * @return string
     */
    public function toString(Uri $uri, int $flags = 0) : string
    {
        return '';
    }
}
