<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 14:28
 */
namespace Madkom\Uri\Scheme;

/**
 * Interface Scheme
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
abstract class Scheme
{
    const PROTOCOL = '';
    /**
     * Checks if scheme handles Authority
     * @return bool
     */
    abstract public function canHandleAuthority() : bool;

    /**
     * Checks if scheme handles Path
     * @return bool
     */
    abstract public function canHandlePath() : bool;

    /**
     * Checks if scheme handles Query
     * @return bool
     */
    abstract public function canHandleQuery() : bool;

    /**
     * Checks if scheme handles Fragment
     * @return bool
     */
    abstract public function canHandleFragment() : bool;

    /**
     * Retrieve uri string representation
     * @return string
     */
    public function toString() : string
    {
        return static::PROTOCOL;
    }
}
