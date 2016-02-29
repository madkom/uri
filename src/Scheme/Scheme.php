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
interface Scheme
{
    /**
     * Checks if scheme handles Authority
     * @return bool
     */
    public function canHandleAuthority() : bool;

    /**
     * Checks if scheme handles Path
     * @return bool
     */
    public function canHandlePath() : bool;

    /**
     * Checks if scheme handles Query
     * @return bool
     */
    public function canHandleQuery() : bool;

    /**
     * Checks if scheme handles Fragment
     * @return bool
     */
    public function canHandleFragment() : bool;

    /**
     * Retrieve uri string representation
     * @return string
     */
    public function toString() : string;
}
