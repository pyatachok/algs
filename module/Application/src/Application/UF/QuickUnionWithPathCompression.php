<?php

namespace Application\UF;


class QuickUnionWithPathCompression  extends QuickUnion
{

	/**
	 * chase parent pointers until reach root (depth of i array accesses)
	 * @param int $i
	 * @return int
	 */
	protected function root($i)
	{
		assert('is_int($i)');

		while ( $i != $this->id[$i] )
		{
			$this->id[$i] = $this->id[ $this->id[$i]];
			$i = $this->id[$i];
		}

		return $i;
	}

}