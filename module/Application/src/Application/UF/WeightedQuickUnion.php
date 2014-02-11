<?php

namespace Application\UF;


class WeightedQuickUnion extends QuickUnion
{
	protected $size = [];

	/**
	 * Создает массив из N объектов
	 * т заполняет массив $size
	 * @param int $N
	 */
	public function __construct( $N)
	{
		assert('is_int($N)');

		for ( $i = 0; $i < $N; $i++)
		{
			$this->id[$i] = $i;
			$this->size[$i] = 1;
		}

	}

	/**
	 * Link root of smaller tree to root of larger tree. Update the size[] 	array.
	 * @param int $p
	 * @param int $q
	 */
	public function union($p, $q)
	{
		$i = $this->root($p);
		$j = $this->root($q);

		if ($i == $j ) return ;

 		if ( $this->size[$i] < $this->size[$j] )
		{
			$this->id[$i] = $j;
			$this->size[$j] += $this->size[$i];
		}
		else
		{
			$this->id[$j] = $i;
			$this->size[$i] += $this->size[$j];
		}
	}
}