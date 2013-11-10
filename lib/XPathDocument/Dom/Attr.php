<?php

/**
 * @module XPathDocument
 * @submodule XPathDocument_Dom_Attr
 * @author Adam Timberlake <adam.timberlake@gmail.com>
 */
class XPathDocument_Dom_Attr extends XPathDocument_Dom_Abstract
{
	/**
     * @method getText
	 * @return string
	 */
	public function getText()
	{
		return $this->_item->value;
	}
}