<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 08:45
 */
namespace Madkom\Uri\Component\Authority\Host;

use InvalidArgumentException;
use Madkom\Uri\Component\Authority\Host;
use TrueBV\Punycode;

/**
 * Class Hostname
 * @package Madkom\Uri\Component\Authority\Host
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Name implements Host
{
    /**
     * @var string Holds hostname
     */
    protected $address;

    /**
     * Hostname constructor.
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->setAddress($address);
    }

    /**
     * Retrieves ASCII formatted hostname
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * Retrieves Unicode hostname
     * @return string
     */
    public function getUnicode() : string
    {
        return $this->getPunnycode()->decode($this->address);
    }

    /**
     * Sets valid hostname in ASCII format
     * @param string $address Host name to set
     */
    protected function setAddress(string $address)
    {
        if (empty($address)) {
            throw new InvalidArgumentException('Empty hostname given');
        }
        if (preg_match('/^((^[\s\.:\/])|([\s\.:\/]$)|(.*[\s:\/].*))$/', $address)) {
            throw new InvalidArgumentException("Invalid hostname, given: {$address}");
        }
        $this->address = $this->getPunnycode()->encode($address);
    }

    protected function getPunnycode()
    {
        static $punnycode;
        if (!isset($punnycode)) {
            $punnycode = new Punycode();
        }

        return $punnycode;
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
