<?php

include_once 'lib/XPathDocument/Dom/Abstract.php';
include_once 'lib/XPathDocument/Dom/List.php';
include_once 'lib/XPathDocument/Dom/Text.php';
include_once 'lib/XPathDocument/Dom/Element.php';
include_once 'lib/XPathDocument/Dom/Attr.php';

class XPathDocument_ListTest extends PHPUnit_Framework_TestCase
{
    private $_xpath;

    public function setUp()
    {
        $fixture        = file_get_contents('tests/RedditFixture.html');
        $dom            = new DOMDocument();
        @$dom->loadHTML($fixture);
        $this->_xpath   = new DOMXPath($dom);
    }

    public function testCanAddItemsAndUseAccessors()
    {
        $firstNode      = new XPathDocument_Dom_Text($this->_xpath->query('//p[@class="title"]/a/text()')->item(0));
        $secondNode     = new XPathDocument_Dom_Element($this->_xpath->query('//p[@class="title"]/a')->item(1));
        $thirdNode      = new XPathDocument_Dom_Attr($this->_xpath->query('//p[@class="title"]/a/attribute::href')->item(2));

        $list = new XPathDocument_Dom_List();
        $list->add($firstNode);
        $list->add($secondNode);
        $list->add($thirdNode);

        $this->assertEquals(count($list), 3);
        $this->assertTrue($list->current() instanceof XPathDocument_Dom_Text);
        $this->assertEquals($list->key(), 0);
        $list->next();
        $this->assertEquals($list->key(), 1);
        $list->rewind();
        $this->assertEquals($list->key(), 0);
        $this->assertTrue($list->valid());
        $this->assertTrue($list->offsetExists(2));
        $this->assertFalse($list->offsetExists(3));
        $this->assertEquals($list->offsetGet(2)->getText(), 'http://www.mickeysfishing.com/');
        $list->offsetSet(3, 'Test');
        $this->assertTrue($list->offsetExists(3));
        $this->assertEquals($list->offsetGet(3), 'Test');
        $list->offsetUnset(3);
        $this->assertFalse($list->offsetExists(3));
        $this->assertEquals(count($list->toArray()), 3);
    }
}