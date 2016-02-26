Uniform Resource Identifier (URI) and Uniform Resource Locator (URL)
====================================================================

This library implements URI and URL specification, based on Java impl and partially on 
[RFC3986](https://tools.ietf.org/html/rfc3986). 

![PHP 7.0](https://img.shields.io/badge/PHP-7.0-8C9CB6.svg?style=flat)
[![Build Status](https://travis-ci.org/madkom/uri.svg?branch=master)](https://travis-ci.org/madkom/uri)
[![Latest Stable Version](https://poser.pugx.org/madkom/uri/v/stable)](https://packagist.org/packages/madkom/uri)
[![Total Downloads](https://poser.pugx.org/madkom/uri/downloads)](https://packagist.org/packages/madkom/uri)
[![License](https://poser.pugx.org/madkom/uri/license)](https://packagist.org/packages/madkom/uri)
[![Coverage Status](https://coveralls.io/repos/github/madkom/uri/badge.svg?branch=master)](https://coveralls.io/github/madkom/uri?branch=master)
[![Code Climate](https://codeclimate.com/github/madkom/uri/badges/gpa.svg)](https://codeclimate.com/github/madkom/uri)
[![Issue Count](https://codeclimate.com/github/madkom/uri/badges/issue_count.svg)](https://codeclimate.com/github/madkom/uri)

---

## Installation

Install with Composer

```
composer require madkom/uri
```

## Requirements

This library requires *PHP* in `~7` version.
At this point this library depends on another own library [madkom/collection](https://packagist.org/packages/madkom/collection) and some external packages:
 
1. [rize/uri-template](https://packagist.org/packages/rize/uri-template): for UriTemplate impl
2. [true/punycode](https://packagist.org/packages/true/punycode): for IDNA domain names conversion
3. [ml/iri](https://packagist.org/packages/ml/iri): for parsing URI _(this will be replaced with own impl because od to many dependencies and not as much RFC compliant impl)_

## Usage

Parsing url string:

```php
use Madkom\Uri\Parser;
use Madkom\Uri\Uri;

$parser = new Parser();

/** @var Uri $uri */
$uri = $parser->parse('http://user:pass@host.tld/some/path?and=query&param=2#fragment');

$uri->getScheme(); // Instance of \Madkom\Uri\Scheme\Http
$uri->getAuthority(); // Instance of \Madkom\Uri\Authority
$uri->getPath(); // Instance of \Madkom\Uri\Path
$uri->getQuery(); // Instance of \Madkom\Uri\Query
```

> **TODO** Missing fragment impl yet.

Parsing isbn uri:

```php
use Madkom\Uri\Parser;
use Madkom\Uri\Uri;

$parser = new Parser();

/** @var Uri $uri */
$uri = $parser->parse('isbn:978-83-283-0525-0'); // Instance of \Madkom\Uri\Uri

$uri->getScheme(); // Instance of \Madkom\Uri\Scheme\Custom
$uri->getAuthority(); // NULL
$uri->getPath(); // Instance of \Madkom\Uri\Path with "978-83-283-0525-0"
$uri->getQuery(); // Instance of \Madkom\Uri\Query which is empty
```

Creating URI object:

```php
use Madkom\Uri\Uri;
use Madkom\Uri\Scheme\Https;
use Madkom\Uri\Authority;
use Madkom\Uri\Authority\Host\IPv6;
use Madkom\Uri\Authority\UserInfo;
use Madkom\Uri\Path;
use Madkom\Uri\Query;
use Madkom\Uri\Query\Parameter;

/** @var Uri $uri */
$uri = new Uri(
    new Https(),
    new Authority(
        new IPv6('::1'),
        443,
        new UserInfo('user', 'pass')
    ),
    new Path([
        'some',
        'path'
    ]),
    new Query([
        new Parameter('name', 'value')
    ])
);

$uri->toString(); // https://user:pass@[::1]:443/some/path?name=value
(string)$uri; // same as above
```

## TODO

* [ ] Implement Uri to string conversion
* [ ] Implement fragment component
* [ ] Replace IRI library with RFC Regex in `\Madkom\Uri\Parser`
* [ ] Implement additional parsing modes in `\Madkom\Uri\Parser\Query` for various languages _(parameter duplicate problem)_
* [ ] Implement normalization
* [ ] Implement UriReference based on *RFC3986*

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