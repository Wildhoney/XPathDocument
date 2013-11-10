<?php

include_once 'lib/XPathDocument/Page.php';
include_once 'lib/XPathDocument/Dom/Abstract.php';
include_once 'lib/XPathDocument/Dom/Package.php';
include_once 'lib/XPathDocument/Dom/List.php';
include_once 'lib/XPathDocument/Dom/Element.php';

class XPathDocument_PageTest extends PHPUnit_Framework_TestCase
{
    private $_instance;
    private $_class;

    public function setUp()
    {
        $fixture            = file_get_contents('tests/RedditFixture.html');
        $this->_class       = new ReflectionClass('XPathDocument_Page');
        $this->_instance    = $this->_class->newInstanceArgs(array($fixture, 'html'));
    }

    public function testCanDefineMemberVariables()
    {
        $domProperty = $this->_class->getProperty('_dom');
        $domProperty->setAccessible(true);

        $contentProperty = $this->_class->getProperty('_content');
        $contentProperty->setAccessible(true);

        $contentTypeProperty = $this->_class->getProperty('_contentType');
        $contentTypeProperty->setAccessible(true);

        $this->assertTrue($domProperty->getValue($this->_instance) instanceof DOMDocument);
        $this->assertTrue(is_string($contentProperty->getValue($this->_instance)));
        $this->assertEquals($contentTypeProperty->getValue($this->_instance), 'html');
    }

    public function testCanQueryNodesUsingXPath()
    {
        $nodes = $this->_instance->query('//p[@class="title"]/a');
        $this->assertEquals(count($nodes), 35);
        $this->assertEquals($nodes->offsetGet(0)->getText(),
            "TIL not only did a man survive his exposure to a space-simulating vacuum, but he was completely fine and walked out on his own.");
    }
}