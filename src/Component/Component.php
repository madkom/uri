<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 14:06
 */

namespace Madkom\Uri\Component;

/**
 * Class Component
 * @package Madkom\Uri\Component
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface Component
{
    /**
     * Retrieve component string representation
     * @return string
     */
    public function toString() : string;

    /**
     * @return string
     */
    public function __toString() : string;
}
