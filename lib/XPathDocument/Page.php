<?php

/**
 * @module XPathDocument
 * @author Adam Timberlake <adam.timberlake@gmail.com>
 */
class XPathDocument_Page
{
    /**
     * @property $_dom
     * @type DOMDocument
     * Holds a reference to the DOMDocument, so that it can be used in such methods
     * as the query method.
     * @private
     */
    private $_dom;

    /**
     * @property $_content
     * @type string
     * Content of the HTML page.
     * @private
     */
    private $_content;

    /**
     * @property $_contentType
     * @type string
     * Stores the content type (HTML/XML) so that when the query() is called again,
     * it can be obtained automatically, instead of having to supply it again manually.
     * @private
     */
    private $_contentType;

    /**
     * @property $_docType
     * @type string
     * Holds the content type, because when we begin to string XPath expressions together
     * (by calling the query method in XPathDocument_Element) a missing DOCTYPE will
     * not parse the file correctly, therefore this DOCTYPE will be prepended to the data.
     * @private
     */
    private $_docType;

    /**
     * @constructor
     * Place the HTML into the DOMDocument class.
     * @param string $content
     * @param string $type
     */
    public function __construct($content, $type = 'html')
    {
        $this->_dom         = new DOMDocument();
        $this->_content     = $content;
        $this->_contentType = $type;

        // Switch the type so that we can load the content in different ways.
        switch ($type)
        {
            // Load a HTML document.
            case ('html'):
                @$this->_dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
                break;

            // Load an XML document.
            case ('xml'):
                @$this->_dom->loadXML($content);
                break;
        }

        // Try and get the DOCTYPE from the content that was passed in, and store it in the
        // member variable if it can be gathered.
        if (preg_match('~(<!DOCTYPE .+?">)~i', $content, $matches))
        {
            $this->_docType = $matches[1];
        }
    }

    /**
     * @method query
     * @param string $expression
     * @param DOMElement $context
     * Perform an XPath query on the current DOMDocument.
     * @throws Exception
     * @return XPathDocument_Dom_List
     */
    public function query($expression, DOMElement $context = null)
    {
        // Find the nodes based on the expression that was passed in.
        $xpath 		= new DOMXPath($this->_dom);
        $nodes      = @$xpath->query($expression);

        if (!$nodes) {
            throw new Exception(sprintf('Invalid expression: "%s"', $expression));
        }

        // Package all of the obtained nodes into their XPathDocument equivalents.
        $package = new XPathDocument_Dom_Package($nodes, $this->_dom);
        return $package->getItems();
    }
}