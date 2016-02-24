<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 14:06
 */

namespace Madkom\Uri;

/**
 * Class Component
 * @package Madkom\Uri
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
