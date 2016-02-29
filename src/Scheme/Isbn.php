<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 29.02.16
 * Time: 11:47
 */
namespace Madkom\Uri\Scheme;

/**
 * Class Isbn
 * @package Madkom\Uri\Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Isbn implements Scheme
{
    const PROTOCOL = 'isbn';

    /**
     * Checks if scheme handles Authority
     * @return bool
     */
    public function canHandleAuthority() : bool
    {
        return false;
    }

    /**
     * Checks if scheme handles Path
     * @return bool
     */
    public function canHandlePath() : bool
    {
        return true;
    }

    /**
     * Checks if scheme handles Query
     * @return bool
     */
    public function canHandleQuery() : bool
    {
        return false;
    }

    /**
     * Checks if scheme handles Fragment
     * @return bool
     */
    public function canHandleFragment() : bool
    {
        return false;
    }

    /**
     * Retrieve uri string representation
     * @return string
     */
    public function toString() : string
    {
        return self::PROTOCOL;
    }
}
