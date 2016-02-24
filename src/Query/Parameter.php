<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 10:26
 */
namespace Madkom\Uri\Query;

/**
 * Class Parameter
 * @package Madkom\Uri\Query
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Parameter
{
    /**
     * @var string Holds parameter name
     */
    private $name;
    /**
     * @var string|integer|array Holds parameter value
     */
    private $value;

    /**
     * Parameter constructor.
     * @param string $name
     * @param $value
     */
    public function __construct(string $name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Retrieves parameter name
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Retrieves parameter value
     * @return array|int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Retrieve parameter as string
     * @return string
     */
    public function toString() : string
    {
        return sprintf("{$this->name}=%s", urlencode($this->value));
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
