<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 07:50
 */
namespace Madkom\Uri\Authority\Host;

use InvalidArgumentException;
use Madkom\Uri\Authority\Host;

/**
 * Class IPv4
 * @package Madkom\Uri\Authority\Host
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class IPv4 implements Host
{
    /**
     * @var string Holds valid IPv4 address
     */
    protected $address;

    /**
     * IPv4 constructor.
     * @param string $ip
     */
    public function __construct(string $ip)
    {
        $this->setAddress($ip);
    }

    /**
     * Retrieve IPv4 address
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * Sets IPv4 address if valid
     * @param string $address IPv4 address to set
     * @return boolean
     * @throws InvalidArgumentException
     */
    protected function setAddress(string $address)
    {
        if (empty($address)) {
            throw new InvalidArgumentException('Empty IPv4 address given');
        }
        if (false === filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            throw new InvalidArgumentException("Invalid IPv4 address, given: {$address}");
        }
        $this->address = $address;
    }

    /**
     * Retrieve component string representation
     * @return string
     */
    public function toString() : string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
