<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 18.02.16
 * Time: 13:27
 */
namespace Madkom\Uri\Component;

use InvalidArgumentException;
use Madkom\RegEx\Matcher;
use Madkom\RegEx\Pattern;
use Madkom\Uri\UriFactory;

/**
 * Class Path
 * @package Madkom\Uri\Component
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Path
{
    const DELIMITER = '/';
    /**
     * @var array Holds path segments
     */
    protected $segments = [];
    /**
     * @var bool Holds relativity info
     */
    private $absolute;

    /**
     * Path constructor.
     * @param array $elements
     * @param bool $absolute
     */
    public function __construct(array $elements = [], bool $absolute = true)
    {
        if (false === $this->isValid($elements)) {
            throw new InvalidArgumentException("Malformed path segments");
        }
        $this->segments = $elements;
        $this->absolute = $absolute;
    }

    /**
     * Checks if path segments are valid
     * @param array $elements
     * @return bool
     */
    private function isValid(array $elements) : bool
    {
        $matcher = new Matcher(new Pattern(UriFactory::PATH_REGEX));
        foreach ($elements as $segment) {
            if (!$matcher->match($segment)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Checks if path is absolute (starting with "/")
     * @return bool
     */
    public function isAbsolute() : bool
    {
        return $this->absolute;
    }

    /**
     * Sets as absolute
     */
    public function setAbsolute()
    {
        $this->absolute = true;
    }

    /**
     * Sets as relative
     */
    public function setRelative()
    {
        $this->absolute = false;
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
     * Removes dot segments and returns new instance of Path
     * @return Path
     */
    public function removeDotSegments() : Path
    {
        $result = clone $this;
        foreach ($result->segments as $index => $segment) {
            if ($segment == '.') {
                unset($result->segments[$index]);
            }
            if ($segment == '..' && $index > 0) {
                unset($result->segments[$index]);
                unset($result->segments[$index - 1]);
            }
        }

        return $result;
    }

    /**
     * Merges two Paths
     * @param Path $path
     * @return Path
     */
    public function merge(Path $path) : Path
    {
        $segments = array_merge(
            $this->segments,
            $path->segments
        );

        return new Path($segments, $this->absolute);
    }

    /**
     * Retrieve path as string
     * @return string
     */
    public function toString() : string
    {
        return ($this->absolute ? self::DELIMITER : "") . implode(self::DELIMITER, array_map('urlencode', $this->segments));
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
