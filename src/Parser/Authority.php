<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 23.02.16
 * Time: 14:58
 */
namespace Madkom\Uri\Parser;

use InvalidArgumentException;
use Madkom\Uri\Authority\Host\IPv4;
use Madkom\Uri\Authority\Host\IPv6;
use Madkom\Uri\Authority\Host\Name;
use Madkom\Uri\Authority\UserInfo;

/**
 * Class Authority
 * @package Madkom\Uri\Parser
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Authority
{
    // Drop numeric, and  "+-." for now
    // Validation of character set is done by isValidAuthority
    //const AUTHORITY_CHARS_REGEX = "a-zA-Z0-9\\-\\."; // allows for IPV4 but not IPV6
    const AUTHORITY_CHARS_REGEX = "((?=[a-z0-9-]{1,63}\\.)[a-z0-9]+(\\-[a-z0-9]+)*\\.)*[a-z]{2,63}"; // allows only for IPV4
    const IPV6_REGEX = "[0-9a-fA-F:]+"; // do this as separate match because : could cause ambiguity with port prefix
    const INNER_OCTET_REGEX = "25[0-5]|2[0-4]\\d|1\\d{2}|[1-9]\\d|[1-9]";
    const MIDDLE_OCTET_REGEX = "25[0-5]|2[0-4]\\d|1\\d{2}|[1-9]\\d|\\d";
    const IPV4_REGEX = "(((" . self::INNER_OCTET_REGEX. ")\\.)((" . self::MIDDLE_OCTET_REGEX . ")\\.){2}" .
        "(" . self::INNER_OCTET_REGEX . "))";

    // userinfo    = *( unreserved / pct-encoded / sub-delims / ":" )
    // unreserved    = ALPHA / DIGIT / "-" / "." / "_" / "~"
    // sub-delims    = "!" / "$" / "&" / "'" / "(" / ")" / "*" / "+" / "," / ";" / "="
    // We assume that password has the same valid chars as user info
    const USERINFO_CHARS_REGEX = "[a-zA-Z0-9%\\-\\._~!$&'\\(\\)\\*\\+,;=]";
    // since neither ':' nor '@' are allowed chars, we don't need to use non-greedy matching
    const USERINFO_FIELD_REGEX = "(?<user>" . self::USERINFO_CHARS_REGEX . "+):" . // Name at least one character
        "(?<password>" . self::USERINFO_CHARS_REGEX . "*)"; // password may be absent
    const AUTHORITY_REGEX = "((?<userInfo>" . self::USERINFO_FIELD_REGEX . ")@)?" .
        "((?<ipv4>" . self::IPV4_REGEX . ")|\\[(?<ipv6>" . self::IPV6_REGEX . ")\\]|(?<hostname>" .
        self::AUTHORITY_CHARS_REGEX . "))(:(?<port>\\d*))?";

    /**
     * Retrieve authority from string
     * @param string $authorityString
     * @return \Madkom\Uri\Authority
     * @throws InvalidArgumentException On non-matching string
     */
    public function parse(string $authorityString) : \Madkom\Uri\Authority
    {
        if (preg_match("/^" . self::AUTHORITY_REGEX . "$/", $authorityString, $match)) {
            if ($match['ipv4']) {
                $host = new IPv4($match['ipv4']);
            } elseif ($match['ipv6']) {
                $host = new IPv6($match['ipv6']);
            } else {
                $host = new Name($match['hostname']);
            }
            if ($match['userInfo']) {
                $userInfo = new UserInfo($match['user'], $match['password']);
            }

            return new \Madkom\Uri\Authority(
                $host,
                empty($match['port']) ? null : intval($match['port']),
                $userInfo ?? null
            );
        }

        throw new InvalidArgumentException("Malformed authority string, given: {$authorityString}");
    }
}
