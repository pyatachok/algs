<?php


namespace Application\UF;

/**
 * Quick-find defect.
 * * Union too expensive ( N array accesses).
 * * Trees are flat, but too expensive to keep them flat.
 *
 * Quick-union defect.
 * * Trees can get tall.
 * * Find too expensive (could be N array accesses).
 */
class QuickUnion extends UF
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
			$i = $this->id[$i];
		}

		return $i;
	}

	/**
	 * check if $p and $q have same root (depth of $p and $q array accesses)
	 * @param int $p
	 * @param int $q
	 * @return bool
	 */
	function connected($p, $q)
	{
		return $this->root($p) == $this->root($q);
	}

	/**
	 * change root of $p to point to root of $q (depth of $p and $q array accesses)
	 * @param int $p
	 * @param int $q
	 */
	function union($p , $q)
	{
		$i = $this->root($p);
		$j = $this->root($q);

		$this->id[$i] = $j;
	}

}