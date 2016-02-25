Uniform Resource Identifier (URI) and Uniform Resource Locator (URL)
====================================================================

This library implements URI and URL specification, based on Java impl and partially on 
[RFC3986](https://tools.ietf.org/html/rfc3986). 

[![Build Status](https://travis-ci.org/madkom/uri.svg?branch=master)](https://travis-ci.org/madkom/uri)
[![Latest Stable Version](https://poser.pugx.org/madkom/uri/v/stable)](https://packagist.org/packages/madkom/uri)
[![Total Downloads](https://poser.pugx.org/madkom/uri/downloads)](https://packagist.org/packages/madkom/uri)
[![License](https://poser.pugx.org/madkom/uri/license)](https://packagist.org/packages/madkom/uri)

---

## Installation

Install with Composer

```
composer require madkom/uri
```

## Usage

Parsing url string:

```php
$parser = new \Madkom\Uri\Parser();
$uri = $parser->parse('http://user:pass@host.tld/some/path?and=query&param=2#fragment');
$uri->getScheme(); // Instance of \Madkom\Uri\Scheme\Http
$uri->getAuthority(); // Instance of \Madkom\Uri\Authority
$uri->getPath(); // Instance of \Madkom\Uri\Path
$uri->getQuery(); // Instance of \Madkom\Uri\Query
```

> **TODO** Missing fragment impl yet.

Parsing isbn uri:

```php
$parser = new \Madkom\Uri\Parser();
$uri = $parser->parse('isbn:978-83-283-0525-0'); // Instance of \Madkom\Uri\Uri
$uri->getScheme(); // Instance of \Madkom\Uri\Scheme\Custom
$uri->getAuthority(); // NULL
$uri->getPath(); // Instance of \Madkom\Uri\Path with "978-83-283-0525-0"
$uri->getQuery(); // Instance of \Madkom\Uri\Query which is empty
```

Creating URI object:

```php
$uri = new \Madkom\Uri\Uri(
    new \Madkom\Uri\Scheme\Https(),
    new \Madkom\Uri\Authority(
        new \Madkom\Uri\Host\IPv6('::1'),
        443,
        new \Madkom\Uri\Authority\UserInfo('user', 'pass')
    ),
    new \Madkom\Uri\Path([
        'some',
        'path'
    ]),
    new \Madkom\Uri\Query([
        new \Madkom\Uri\Query\Parameter('name', 'value')
    ])
);

$uri->toString(); // https://user:pass@[::1]:443/some/path?name=value
(string)$uri; // same as above
```

## TODO

[ ] Implement Uri to string conversion
[ ] Implement fragment component
[ ] Replace IRI library with RFC Regex in `\Madkom\Uri\Parser`
[ ] Implement additional parsing modes in `\Madkom\Uri\Parser\Query` for various languages _(parameter duplicate problem)_
[ ] Implement normalization
[ ] Implement UriReference based on *RFC3986*

## License

The MIT License (MIT)

Copyright (c) 2016 Madkom S.A.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.