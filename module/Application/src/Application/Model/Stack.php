<?php

/**
 * Created by mice
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model;


use Application\Model\LinkedList\Node;

class Stack implements StackQueryInterface
{

	/**
	 * @var Node
	 */
	private $first = null;

	/**
	 * Create an empty stack
	 */
	public function __construct()
	{
		// TODO: Implement __construct() method.
	}

	/**
	 * is the stack empty
	 * @return bool
	 */
	public function isEmpty()
	{
		return $this->first == null;
	}

	/**
	 * insert a new string into stack
	 * @param string $item
	 */
	public function push($item)
	{
		assert('is_string($item)');

		$oldFirst = $this->first;
		$this->first = new Node($item, $oldFirst);
	}

	/**
	 * Remove and return the string
	 * @return string
	 */
	public function pop()
	{
		$item = $this->first->item;
		$this->first = $this->first->next;

		return $item;
	}
}