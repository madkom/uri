<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 09:35
 */
namespace Madkom\Uri;

use Madkom\Collection\CustomDistinctCollection;
use Madkom\Uri\Query\Parameter;

/**
 * Class Query
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Query extends CustomDistinctCollection
{
    const DUPLICATES_NATIVE = 0;
    const DUPLICATES_AS_ARRAY = 1;
    const DUPLICATES_WITH_COLON = 2;

    const DELIMITER = '&';
    /**
     * Custom constructor from String
     * @param string $queryString
     * @return Query
     */
    public static function createFromString(string $queryString) : self
    {
        $query = new self();
        parse_str($queryString, $parameters);
        foreach ($parameters as $name => $value) {
            $query->add(new Parameter($name, $value));
        }

        return $query;
    }

    /**
     * @return string
     */
    protected function getType() : string
    {
        return Parameter::class;
    }

    /**
     * @return string
     */
    protected function getMethod() : string
    {
        return 'getName';
    }

    /**
     * Retrieve query as query string
     * @return string
     */
    public function toString() : string
    {
        return ($this->count() > 0 ? '?' : '') . implode(self::DELIMITER, $this->elements);
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
