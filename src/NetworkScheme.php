<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 16.02.16
 * Time: 05:44
 */
namespace Madkom\Uri;

/**
 * Class Scheme
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface NetworkScheme extends Scheme
{
    /**
     * Retrieve default port
     * @return int
     */
    public function getPort() : int;
}
