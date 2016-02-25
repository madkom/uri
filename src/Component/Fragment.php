<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.02.16
 * Time: 13:27
 */
namespace Madkom\Uri\Component;

/**
 * Class Fragment
 * @package Madkom\Uri\Component
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Fragment implements Component
{
    /**
     * @var string Holds fragment
     */
    protected $fragment;

    /**
     * Fragment constructor.
     * @param string $fragment
     */
    public function __construct(string $fragment = '')
    {
        $this->fragment = $fragment;
    }

    /**
     * Retrieve fragment
     * @return string
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * Sets fragment
     * @param string $fragment
     */
    public function setFragment($fragment)
    {
        $this->fragment = $fragment;
    }

    /**
     * Retrieve component string representation
     * @return string
     */
    public function toString() : string
    {
        return $this->fragment;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->toString();
    }
}
