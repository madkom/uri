<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 14:28
 */
namespace Madkom\Uri\Scheme;

use Madkom\Uri\Component\Authority;
use Madkom\Uri\Component\Fragment;
use Madkom\Uri\Component\Path;
use Madkom\Uri\Component\Query;
use Madkom\Uri\Uri;

/**
 * Interface Scheme
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface Scheme
{
    /**
     * Compose uri from parsed components
     * @param Authority $authority
     * @param Path $path
     * @param Query $query
     * @param Fragment $fragment
     * @return Uri
     */
    public function compose(Authority $authority, Path $path, Query $query, Fragment $fragment) : Uri;

    /**
     * Retrieve uri string representation
     * @param Uri $uri Uri to convert to string
     * @param int $flags String conversion flags
     * @return string
     */
    public function toString(Uri $uri, int $flags = 0) : string;
}
