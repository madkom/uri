<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 18.02.16
 * Time: 13:27
 */
namespace Madkom\Uri\Component;

use InvalidArgumentException;

/**
 * Class Path
 * @package Madkom\Uri\Component
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Path
{
    const DELIMITER = '/';
    const PATH_REGEX = "/^([^\\/?#]*)$/";
    /**
     * @var string Holds path segments
     */
    protected $segments = [];

    /**
     * Path constructor.
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        if (false === $this->isValid($elements)) {
            throw new InvalidArgumentException("Malformed path segments");
        }
        $this->segments = $elements;
    }

    /**
     * Checks if path segments are valid
     * @param array $elements
     * @return bool
     */
    private function isValid(array $elements) : bool
    {
        foreach ($elements as $segment) {
            if (!preg_match(self::PATH_REGEX, $segment)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Custom constructor from string
     * @param string $path
     * @return Path
     */
    public static function createFromString(string $path) : self
    {
        return new self(explode(self::DELIMITER, ltrim($path, self::DELIMITER)));
    }

    /**
     * Retrieve path segments
     * @return array
     */
    public function getSegments() : array
    {
        return $this->segments;
    }

    /**
     * Retrieve path as string
     * @return string
     */
    public function toString() : string
    {
        return self::DELIMITER . implode(self::DELIMITER, array_map('urlencode', $this->segments));
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
