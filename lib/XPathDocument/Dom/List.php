<?php

/**
 * @module XPathDocument
 * @submodule XPathDocument_Dom_List
 * @author Adam Timberlake <adam.timberlake@gmail.com>
 */
class XPathDocument_Dom_List implements Iterator, ArrayAccess, Countable
{
	/**
     * @property $_position
     * @type integer
	 * Keeps a track of the current position in the array.
     * @private
	 */
	private $_position = 0;
	
	/**
     * @property $_list
     * @type array
	 * Contains a list of the items.
     * @private
	 */
	private $_list = array();
	
	/**
     * @method add
     * @param mixed $item
	 * Inject an item into the array.
     * @return void
	 */
	public function add($item)
	{
		$this->_list[] = $item;
	}

	/**
     * @method rewind
	 * Reset to the beginning of the array.
	 * @return void
	 */
    public function rewind()
    {
        $this->_position = 0;
    }

    /**
     * @method current
     * Fetch the current array item.
     * @return object
     */
    public function current()
    {
        return @$this->_list[$this->_position];
    }

    /**
     * @method key
     * Return the current index.
     * @return integer
     */
    public function key()
    {
        return $this->_position;
    }

    /**
     * @method next
     * Move the array index forward one.
     * @return void
     */
    public function next()
    {
        ++$this->_position;
    }

    /**
     * @method valid
     * Checks whether the current index is a valid one or not.
     * @return boolean
     */
    public function valid()
    {
        return (bool) isset($this->_list[$this->_position]);
    }

    /**
     * @method offsetExists
     * @param integer $index
     * Check whether an offset exists.
     * @return boolean
     */
	public function offsetExists($index)
	{
		return (bool) array_key_exists($index, $this->_list);
	}

	/**
     * @method offsetGet
     * @param integer $index
	 * Get the value at a particular offset.
	 * @return mixed
	 */
	public function offsetGet($index)
	{
		return $this->_list[$index];
	}

	/**
     * @method offsetSet
     * @param integer $index
     * @param string $value
	 * Set the value at a particular offset.
	 * @return XPathDocument_Dom__List
	 */
	public function offsetSet($index, $value)
	{
		$this->_list[$index] = $value;
		return $this;
	}

	/**
     * @method offsetUnset
     * @param integer $index
	 * Unset an the specified index.
	 * @return XPathDocument_Dom_List
	 */
	public function offsetUnset($index)
	{
		unset($this->_list[$index]);
		return $this;
	}

	/**
     * @method count
	 * Count the items in the list.
	 * @return integer
	 */
	public function count()
	{
		return count($this->_list);
	}

    /**
     * @method toArray
     * @return array
     */
    public function toArray()
    {
        $collection = array();

        foreach ($this->_list as $list) {
            array_push($collection, $list->getText());
        }

        return $collection;
    }
}