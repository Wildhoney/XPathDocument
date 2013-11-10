<?php

/**
 * @module XPathDocument
 * @submodule XPathDocument_Dom_Package
 * @author Adam Timberlake <adam.timberlake@gmail.com>
 */
class XPathDocument_Dom_Package
{
    /**
     * @property $_list
     * @type object
     * @private
     */
    private $_list;

    /**
     * @constructor
     * @param DOMNodeList $nodes
     * @param DOMDocument $dom
     * Package all of the DOM* classes into their XPathDocument equivalents, so that we can
     * continue to extend DOMDocument.
     * @throws Exception
     * @return \XPathDocument_Dom_Package
     */
    public function __construct(DOMNodeList $nodes, DOMDocument $dom)
    {
        // Create the list that we'll populate.
        $list = new XPathDocument_Dom_List();

        // Loop through all of the nodes, injecting each one into XPathDocument_Dom_List.
        foreach ($nodes as $node) {

            // Converts things like DOMElement into XPathDocument_Dom_Element.
            $className	= get_class($node);
            $className	= str_replace('DOM', '', $className);
            $className 	= sprintf('XPathDocument_Dom_%s', $className);

            // If this class does not exist, then throw an exception.
            if (!class_exists($className)) {
                throw new Exception('Cannot find DOM class: ' . $className);
            }

            // Package the DOM class into a special XPathDocument class representing the DOM.
            $class = new $className($node);

            $class->injectDom($dom);
            $list->add($class);
        }

        $this->_list = $list;
    }

    /**
     * @method getItems
     * @return object
     */
    public function getItems()
    {
        return $this->_list;
    }
}