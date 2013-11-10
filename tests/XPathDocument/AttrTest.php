<?php

include_once 'lib/XPathDocument/Dom/Abstract.php';
include_once 'lib/XPathDocument/Dom/Attr.php';

class XPathDocument_AttrTest extends PHPUnit_Framework_TestCase
{
    private $_xpath;

    public function setUp()
    {
        $fixture        = file_get_contents('tests/RedditFixture.html');
        $dom            = new DOMDocument();
        @$dom->loadHTML($fixture);
        $this->_xpath   = new DOMXPath($dom);
    }

    public function testCanGetAttributeText()
    {
        $firstNode  = $this->_xpath->query('//a[@href and contains(@class, "author")]/attribute::href')->item(0);
        $attribute  = new XPathDocument_Dom_Attr($firstNode);
        $this->assertEquals($attribute->getText(), 'http://www.reddit.com/user/wes_the_rad');
    }
}