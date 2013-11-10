<?php

/**
 * @module XPathDocument
 * @submodule XPathDocument_Dom_Abstract
 * @author Adam Timberlake <adam.timberlake@gmail.com>
 */
abstract class XPathDocument_Dom_Abstract
{
    /**
     * @property $_item
     * @protected
     */
    protected $_item;

    /**
     * @property $_dom
     * @protected
     */
    protected $_dom;

    /**
     * @abstract getText
     */
    public abstract function getText();
	
	/**
     * @constructor
     * @param object $item
	 * Takes whatever DOM* class was passed into it and assigns it to the variable.
	 */
	public function __construct($item)
	{
		$this->_item = $item; 
	}
	
	/**
     * @method _toHtml
	 * @param DOMElement $node
     * Get the content of the node without stripping its HTML away.
	 * @return string
     * @protected
	 */
	protected function _toHtml(DOMElement $node)
	{
		# If there are no child nodes, then we might as well return the current value.
		if (!count($node->childNodes)){
			return $node->nodeValue;
		}
	
		# Otherwise we will create a new DOMDocument, and then invoke the saveHTML() method.
		$dom = new DOMDocument();
	
		# Append all of the current child's nodes into the new DOMDocument.
		foreach($node->childNodes as $child) {
			$dom->appendChild($dom->importNode($child, true));
		}

		# And then return its HTML.
		return $dom->saveHTML();
	}

    /**
     * @method _filterOutput
     * @param string $value
     * Filters values returned by getText() and getHtml(), stripping
     * any trailing whitespace, \n, \r or \t.
     * @return string
     * @protected
     */
    protected function _filterOutput($value)
    {
        return trim($value, " \n\r\t");
    }

    /**
     * @method injectDom
     * @param DOMDocument $dom
     * @return void
     */
    public function injectDom(DOMDocument $dom)
	{
		$this->_dom = $dom;
	}
}