<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 14:02
 */
namespace Madkom\Uri\Scheme;

use Madkom\Uri\NetworkScheme;

/**
 * Class Https
 * @package Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Https implements NetworkScheme
{
    const PROTOCOL = 'https';
    /**
     * Retrieve protocol name
     * @return string
     */
    public function getScheme() : string
    {
        return 'https';
    }

    /**
     * Retrieve default port
     * @return int
     */
    public function getPort() : int
    {
        return 443;
    }
}
