<?php


namespace Application\UF;


abstract class UF implements UFInterface
{

	protected $id = [];

	/**
	 * Создает массив из N объектов
	 * @param int $N
	 */
	public function __construct( $N)
	{
		assert('is_int($N)');

		for ( $i = 0; $i < $N; $i++)
		{
			$this->id[$i] = $i;
		}

	}

	/**
	 * Создает связь между $p и $q
	 * @param int $p
	 * @param int $q
	 */
	public function union( $p, $q)
	{
		assert('is_int($p)');
		assert('is_int($q)');


		$pid = $this->id[$p];
		$qid = $this->id[$q];
		for ( $i = 0; $i < $this->count(); $i++ )
		{
			if ( $this->id[$i] == $pid )
			{
				$this->id[$i] = $qid;
			}
		}
	}

	/**
	 * Проверяет связанность объектов $p и $q
	 * @param int $p
	 * @param int $q
	 * @return bool
	 */
	public function connected( $p, $q)
	{
		assert('is_int($p)');
		assert('is_int($q)');

		return $this->id[$p] == $this->id[$q];
	}

	public function find( $p)
	{
		assert('is_int($p)');

		return $this->id[$p];
	}

	public function count()
	{
		return count($this->id);
	}

	public function getIdArray()
	{
		return $this->id;
	}
}