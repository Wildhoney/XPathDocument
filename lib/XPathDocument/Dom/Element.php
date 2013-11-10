<?php

/**
 * @module XPathDocument
 * @submodule XPathDocument_Dom_Attr
 * @author Adam Timberlake <adam.timberlake@gmail.com>
 */
class XPathDocument_Dom_Element extends XPathDocument_Dom_Abstract
{
    /**
     * @method getText
     * @return string
     */
    public function getText()
    {
        return $this->_filterOutput($this->_item->nodeValue);
    }

    /**
     * @method getHtml
     * @return string
     */
    public function getHtml()
    {
        return $this->_filterOutput($this->_toHtml($this->_item));
    }

    /**
     * @method getName
     * @return string
     */
    public function getName()
    {
        return $this->_item->nodeName;
    }

    /**
     * @method getAttribute
     * @param string $name
     * Get the attribute's value based on its name.
     * @return string
     */
    public function getAttribute($name)
    {
        return $this->_item->getAttribute($name);
    }

    /**
     * @method query
     * @param string $expression
     * Query the remaining HTML.
     * @return array
     */
    public function query($expression)
    {
        // Any child XPath expressions mustn't be prepended with "//", but it's a common mistake, so
        // remove them.
        $expression = str_replace('//', '', $expression);

        // Find the nodes based on the expression that was passed in.
        $xpath 		= new DOMXPath($this->_dom);
        $nodes		= $xpath->query($expression, $this->_item);

        // Package all of the obtained nodes into their XPathDocument_Dom equivalents.
        $package = new XPathDocument_Dom_Package($nodes, $this->_dom);
        return $package->getItems();
    }
}