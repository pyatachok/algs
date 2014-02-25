<?php

/**
 * Created by mice
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model\LinkedList;


class Node
{
	/**
	 * @var string
	 */
	public $item;

	/**
	 * @var Node
	 */
	public $next;

	public function __construct($item = '', $next = null)
	{
		$this->item = $item;
		$this->next = $next;
	}
}