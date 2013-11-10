<?php

include_once './../../lib/XPathDocument/Dom/Abstract.php';
include_once './../../lib/XPathDocument/Dom/Element.php';
include_once './../../lib/XPathDocument/Dom/Package.php';
include_once './../../lib/XPathDocument/Dom/List.php';

class XPathDocument_TextTest extends PHPUnit_Framework_TestCase
{
    private $_xpath;
    private $_dom;

    public function setUp()
    {
        $fixture        = file_get_contents('./../RedditFixture.html');
        $this->_dom     = new DOMDocument();
        @$this->_dom->loadHTML($fixture);
        $this->_xpath   = new DOMXPath($this->_dom);
    }

    public function testCanGetElementProperties()
    {
        $firstNode  = $this->_xpath->query('//p[@class="title"]/a')->item(4);
        $element    = new XPathDocument_Dom_Element($firstNode);

        $this->assertEquals($element->getText(),
            'What tourist place (city, amusement park, etc.) Is severely overrated?');
        $this->assertEquals($element->getName(), 'a');
        $this->assertEquals($element->getAttribute('class'), 'title loggedin');
    }

    public function testCanChainQueries()
    {
        $firstNode  = $this->_xpath->query('//p[@class="title"]')->item(5);
        $element    = new XPathDocument_Dom_Element($firstNode);
        $element->injectDom($this->_dom);
        $anchorNode = $element->query('a');
        $this->assertEquals($anchorNode->offsetGet(0)->getText(),
            'One of the few waterfalls to dump directly into the ocean: McWay Falls in Big Sur, CA [OC] [3264x2448]');
    }
}