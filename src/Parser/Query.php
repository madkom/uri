<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 14:57
 */
namespace Madkom\Uri\Parser;

use Madkom\Uri\Component\Query as QueryComponent;
use Madkom\Uri\Component\Query\Parameter;
use UnexpectedValueException;

/**
 * Class Query
 * @package Madkom\Uri\Parser
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Query
{
    // Parse mode where parameter duplicate replaces previous parameter
    const DUPLICATE_LAST = 1;
    // TODO: implement
    const DUPLICATES_AS_ARRAY = 1;
    const DUPLICATES_WITH_COLON = 2;
    /**
     * Parse query string into query
     * @param string $queryString String with query to parse
     * @param int $mode Parse mode {@see self::DUPLICATE_LAST}
     * @return QueryComponent
     */
    public function parse(string $queryString, int $mode = 1) : QueryComponent
    {
        $query = new QueryComponent();
        switch ($mode) {
            case self::DUPLICATE_LAST:
                parse_str($queryString, $parameters);
                foreach ($parameters as $name => $value) {
                    $query->add(new Parameter($name, $value));
                }
                break;
            default:
                throw new UnexpectedValueException("Unsupported query parser mode, given: {$mode}");
        }

        return $query;
    }
}
