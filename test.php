<?php

use Madkom\Uri\Uri;
use Madkom\Uri\Url;

require 'vendor/autoload.php';

$parser = new \Madkom\Uri\Parser\Authority();
dump($parser->parse('m.brzuchalski:ala-ma-kota!@brzuchalski.a-a.com'));
//dump($parser->parse('mbrzuchalski:ala-ma-kota!@254.127.17.1:9999'));
//dump($parser->parse('mbrzuchalski:ala-ma-kota!@[::1]:9999'));
die("\nfertig");

$uri = Uri::createFromString('http://madkom.pl/environment/tech?dev=0&test[]=1&test[]=2&test[]=3#part-1');
dump($uri);

$url = $uri->getUrl();
dump($url);

//$url = new Url('//zażółć-gęślą-jaźń.madkom.pl/tech?dev=0#part-1');
//dump($url);
//
//$url = new Url('//[::1]:88/tech?dev=0#part-1');
//dump($url);
//
//$url = new Url('//127.0.0.1:8888/tech?dev=0#part-1');
//dump($url);
//
//$isbn = new Uri('isbn:1-4028-9462-7');
//dump($isbn);
