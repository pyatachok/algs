<?php

/**
 * Created by mice
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model;


interface StackQueryInterface {

	/**
	 * Create an empty stack
	 */
	public function __construct();

	/**
	 * insert a new string into stack
	 * @param string $item
	 */
	public function push( $item );

	/**
	 * Remove and return the string
	 * @return string
	 */
	public function pop ();

	/**
	 * is the stack empty
	 * @return bool
	 */
	public function isEmpty();

}