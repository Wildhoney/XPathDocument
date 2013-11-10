<?php

include_once './../../lib/XPathDocument/Dom/Abstract.php';
include_once './../../lib/XPathDocument/Dom/Text.php';

class XPathDocument_TextTest extends PHPUnit_Framework_TestCase
{
    private $_xpath;

    public function setUp()
    {
        $fixture        = file_get_contents('./../RedditFixture.html');
        $dom            = new DOMDocument();
        @$dom->loadHTML($fixture);
        $this->_xpath   = new DOMXPath($dom);
    }

    public function testCanGetTextValue()
    {
        $firstNode  = $this->_xpath->query('//p[@class="title"]/a/text()')->item(0);
        $attribute  = new XPathDocument_Dom_Text($firstNode);
        $this->assertEquals($attribute->getText(),
            'TIL not only did a man survive his exposure to a space-simulating vacuum, but he was completely fine and walked out on his own.');
    }
}