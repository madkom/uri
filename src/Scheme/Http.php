<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 14:00
 */
namespace Madkom\Uri\Scheme;

/**
 * Class Http
 * @package Madkom\Uri\Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Http implements Scheme
{
    const PROTOCOL = 'http';

    /**
     * Checks if scheme handles Authority
     * @return bool
     */
    public function canHandleAuthority() : bool
    {
        return true;
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
        return true;
    }

    /**
     * Checks if scheme handles Fragment
     * @return bool
     */
    public function canHandleFragment() : bool
    {
        return true;
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
