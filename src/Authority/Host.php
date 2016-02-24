<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 07:49
 */
namespace Madkom\Uri\Authority;

use Madkom\Uri\Component;

/**
 * Interface Address
 * @package Madkom\Uri\Authority
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface Host extends Component
{
    public function getAddress() : string;
}
