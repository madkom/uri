<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 14:06
 */
namespace Madkom\Uri\Component;

use InvalidArgumentException;
use Madkom\Uri\Component\Authority\Host;
use Madkom\Uri\Component\Authority\UserInfo;

/**
 * Class Authority
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Authority implements Component
{
    /**
     * @var Host
     */
    private $host;
    /**
     * @var int
     */
    private $port;
    /**
     * @var UserInfo
     */
    private $userInfo;

    /**
     * Authority constructor.
     * @param Host $host
     * @param int|null $port
     * @param UserInfo|null $userInfo
     */
    public function __construct(Host $host, int $port = null, UserInfo $userInfo = null)
    {
        $this->host = $host;
        if (null !== $port) {
            $this->setPort($port);
        }
        $this->userInfo = $userInfo;
    }

    /**
     * Retrieve host
     * @return Host
     */
    public function getHost() : Host
    {
        return $this->host;
    }

    /**
     * Sets host
     * @param Host $host
     */
    public function setHost(Host $host)
    {
        $this->host = $host;
    }

    /**
     * Retrieve port number
     * @return int|null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Sets port number from range 0-65535
     * @param int $port
     * @throws InvalidArgumentException On invalid port number out from range 0-65535
     */
    public function setPort(int $port)
    {
        if ($port <= 0 || $port > 65535) {
            throw new InvalidArgumentException("Invalid port number, must be in range 0-65535, given: {$port}");
        }

        $this->port = $port;
    }

    /**
     * Retrieve user info
     * @return UserInfo
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }

    /**
     * Sets user info
     * @param UserInfo $userInfo
     */
    public function setUserInfo($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * Retrieve component string representation
     * @return string
     */
    public function toString() : string
    {
        return (null !== $this->userInfo ? "{$this->userInfo}@" : null) .
            (null !== $this->host ? (string)$this->host : null) .
            (null !== $this->port ? ":{$this->port}" : null);
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
