<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 09:35
 */
namespace Madkom\Uri\Component;

use Madkom\Collection\CustomDistinctCollection;
use Madkom\Uri\Component\Query\Parameter;

/**
 * Class Query
 * @package Madkom\Uri\Component
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Query extends CustomDistinctCollection
{
    const DELIMITER = '&';
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
     * @param string $delimiter
     * @return string
     */
    public function toString(string $delimiter = self::DELIMITER) : string
    {
        return implode($delimiter, $this->elements);
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
