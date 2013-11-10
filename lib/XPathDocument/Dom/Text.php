<?php

/**
 * @module XPathDocument
 * @submodule XPathDocument_Dom_Text
 * @author Adam Timberlake <adam.timberlake@gmail.com>
 */
class XPathDocument_Dom_Text extends XPathDocument_Dom_Abstract
{
    /**
     * @method getText
     * @return string
     */
    public function getText()
    {
        return $this->_item->wholeText;
    }
}