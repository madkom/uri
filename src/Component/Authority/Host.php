<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 17.02.16
 * Time: 07:49
 */
namespace Madkom\Uri\Component\Authority;

use Madkom\Uri\Component\Component;

/**
 * Interface Address
 * @package Madkom\Uri\Component\Authority
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface Host extends Component
{
    public function getAddress() : string;
}
