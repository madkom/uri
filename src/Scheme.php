<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 14:28
 */
namespace Madkom\Uri;

/**
 * Interface Scheme
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface Scheme
{
    /**
     * Retrieve protocol name
     * @return string
     */
    public function getScheme() : string;
}
