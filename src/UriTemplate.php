<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 16.02.16
 * Time: 09:47
 */
namespace Madkom\Uri;

use Rize\UriTemplate\UriTemplate as RizeUriTemplate;

/**
 * Class UriTemplate
 * @package Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class UriTemplate
{
    /**
     * @var string
     */
    private $template;

    /**
     * UriTemplate constructor.
     * @param string $template
     */
    public function __construct(string $template)
    {
        $this->template = $template;
    }

    /**
     * Expand Uri template with given params
     * @param array $params
     * @return string
     */
    public function expand(array $params = []) : string
    {
        return $this->getUriTemplate()->expand($this->template, $params);
    }

    /**
     * Extract params from uri with template
     * @param string $uri
     * @param bool $strict
     * @return array
     */
    public function extract(string $uri, bool $strict = false) : array
    {
        return $this->getUriTemplate()->extract($this->template, $uri, $strict);
    }

    /**
     * @return RizeUriTemplate
     */
    protected function getUriTemplate() : RizeUriTemplate
    {
        static $uriTemplate;
        if (!isset($uriTemplate)) {
            $uriTemplate = new RizeUriTemplate();
        }

        return $uriTemplate;
    }
}
