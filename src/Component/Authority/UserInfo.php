<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 13:35
 */
namespace Madkom\Uri\Component\Authority;

use InvalidArgumentException;
use Madkom\RegEx\Matcher;
use Madkom\RegEx\Pattern;
use Madkom\Uri\Component\Component;
use Madkom\Uri\UriFactory;

/**
 * Class UserInfo
 * @package Madkom\Uri\Component\Authority
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class UserInfo implements Component
{
    const DELIMITER = ':';
    /**
     * @var string User name
     */
    private $username;
    /**
     * @var string User password
     */
    private $password;

    /**
     * UserInfo constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->setUsername($username);
        $this->setPassword($password);
    }
    
    /**
     * Retrieve username
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * Sets username
     * @param string $username
     */
    public function setUsername(string $username)
    {
        if (false === $this->isValidUsername($username)) {
            throw new InvalidArgumentException("Invalid username given: {$username}");
        }
        $this->username = $username;
    }

    /**
     * Retrieve password
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * Sets password
     * @param string $password
     */
    public function setPassword(string $password)
    {
        if (false === $this->isValidPassword($password)) {
            throw new InvalidArgumentException("Invalid password given: {$password}");
        }
        $this->password = $password;
    }

    /**
     * Checks if username is valid
     * @param string $username
     * @return bool
     */
    public function isValidUsername(string $username) : bool
    {
        $matcher = new Matcher(new Pattern("^(" . UriFactory::USERINFO_CHARS_REGEX . "+)$"));

        return !empty($matcher->match($username));
    }

    /**
     * Checks if password is valid
     * @param string $password
     * @return bool
     */
    public function isValidPassword(string $password) : bool
    {
        $matcher = new Matcher(new Pattern("^(" . UriFactory::USERINFO_CHARS_REGEX . "*)$"));

        return !empty($matcher->match($password));
    }

    /**
     * Retrieve component string representation
     * @return string
     */
    public function toString() : string
    {
        return empty($this->password) ? $this->username : $this->username . self::DELIMITER . $this->password;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
