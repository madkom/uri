<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 14:25
 */
namespace Madkom\Uri\Scheme;

use Madkom\Uri\Scheme;

/**
 * Class Custom
 * @package Scheme
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Custom implements Scheme
{
    /**
     * @var string Scheme name
     */
    protected $scheme;

    public function __construct(string $scheme)
    {
        $this->scheme = $scheme;
    }

    /**
     * Retrieve protocol name
     * @return string
     */
    public function getScheme() : string
    {
        return $this->scheme;
    }
}
