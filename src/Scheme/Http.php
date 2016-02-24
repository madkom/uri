<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 14:00
 */
namespace Madkom\Uri\Scheme;

use Madkom\Uri\NetworkScheme;

/**
 * Class Http
 * @package Madkom\Uri\Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Http implements NetworkScheme
{
    const PROTOCOL = 'http';
    /**
     * Retrieve protocol name
     * @return string
     */
    public function getScheme() : string
    {
        return self::PROTOCOL;
    }

    /**
     * Retrieve default port
     * @return int
     */
    public function getPort() : int
    {
        return 80;
    }
}
