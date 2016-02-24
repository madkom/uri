<?php

namespace spec\Madkom\Uri;

use Madkom\Uri\Template;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UriTemplateSpec
 * @package spec\Madkom\Uri
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 * @mixin Template
 */
class TemplateSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('http://{host}{/segments*}/{file}{.extensions*}');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Template::class);
    }

    function it_can_expand_template()
    {
        $this->expand([
            'host'       => 'www.host.com',
            'segments'   => ['path', 'to', 'a'],
            'file'       => 'file',
            'extensions' => ['x', 'y'],
        ])->shouldReturn('http://www.host.com/path/to/a/file.x.y');
    }

    function it_can_stract_uri()
    {
        $this->beConstructedWith('/search/{term:1}/{term}/{?q*,limit}');
        $extracted = $this->extract('/search/j/john/?q=a&q=b&limit=10');
        $extracted->shouldBeArray();
        $extracted->shouldReturn([
            'term:1' => 'j',
            'term' => 'john',
            'limit' => '10',
            'q' => ['a', 'b'],
        ]);
    }
}
