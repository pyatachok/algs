<?php


namespace Application\UF\Percolation;

use Application\UF\WeightedQuickUnion;
use Application\UF\QuickUnion;

class Percolation
{
	/**
	 * Size of matrix
	 * @var int
	 */
	private $N = 0;

	/**
	 * Matrix id[N]
	 * @var array
	 */
	private $id = [];


	/**
	 * Matrix sites[N][N]
	 * @var array
	 */
	private $sites = [];

	private $virtualTopId = 0;
	private $virtualBottomId = 0;
	private $alg = null;


	/**
	 * create N-by-N grid, with all sites blocked
	 * @param int $N
	 */
	public function __construct( $N )
	{
		$this->N = (int) $N;
		for ( $i = 0; $i < $N; $i ++ )
		{
			for ( $j = 0; $j < $N; $j ++ )
			{
				$this->sites[$i][$j] = 0;
			}
		}

		$this->virtualTopId = $N*$N;
		$this->virtualBottomId = $this->virtualTopId+1;
		$this->alg = new WeightedQuickUnion($this->virtualTopId+2);

		$this->fillVirtualSites();
	}

	/**
	 * open site (row i, column j) if it is not already
	 * @param int $i
	 * @param int $j
	 */
	public function open ( $i, $j )
	{

		if ( $this->siteExists($i, $j ) )
		{
			if ( ! $this->isOpen($i, $j) )
			{
				$this->sites[$i][$j] = 1;
				$that = (int) $i*$this->N + $j;

				$neighbours = $this->getOpenNeighbours($i, $j);

				foreach ( $neighbours as $neighbour )
				{
					if ( $neighbour >=0 && $neighbour < $this->virtualTopId )
					{
						if ( ! $this -> alg -> connected ( $that, $neighbour ))
						{
							$this->alg -> union( $that, $neighbour);
						}
					}
				}
				
			}
			
			foreach ($this ->sites as $row => $siteRow )
			{
				foreach ($siteRow as $col => $site)
				if ( $this->isFull($row, $col) && $this -> isOpen ( $row, $col ))
				{
					$this->sites[$row][$col] = 2;
				}
			}
		}
	}

	/**
	 * is site (row i, column j) open?
	 * @param $i
	 * @param $j
	 * @return bool
	 */
	function isOpen ( $i, $j )
	{
		if ( $this -> siteExists( $i, $j ) )
		{
			return   $this -> sites[$i][$j] > 0 ;
		}

		return false;
	}

	/**
	 * is site (row i, column j) full?
	 * @param $i
	 * @param $j
	 * @return bool
	 */
	function isFull ( $i, $j )
	{
		if ( $this -> siteExists( $i, $j ) )
		{
			$that = (int) $i*$this->N + $j;
			return $this->alg -> connected($that, $this->virtualTopId);
		}

		return false;
	}

	/**
	 * does the system percolate?
	 */
	public function percolates()
	{
		return $this->alg -> connected($this->virtualTopId, $this->virtualBottomId);
	}

	/**
	 * Возвращает матрицу сайтов
	 * @return array
	 */
	public function draw()
	{
		return $this->sites;
	}

	/**
	 * Добавляет к матрице id 2 виртуальных объекта
	 * и соодинения
	 */
	private function fillVirtualSites()
	{
		for ( $i = 0; $i< $this->N; $i++)
		{
			$this->alg -> union ( $i, $this->virtualTopId);
			$this->alg -> union ( ($this->virtualTopId-$i-1), $this->virtualBottomId);
		}
	}



	/**
	 * Проверяет существует ли такой элемент в матрице
	 * @param int $i
	 * @param int $j
	 * @return bool
	 */
	private function siteExists ( $i, $j )
	{
		assert( 'is_int($i)' );
		assert( 'is_int($j)' );
		return  isset ( $this -> sites [ $i ] [ $j ] ) ;
	}

	private function getOpenNeighbours($i, $j)
	{
		$neighbours[] = ( $this->isOpen($i-1, $j) 		? ($i-1)*$this->N + $j 		: null );
		$neighbours[] = ( $this->isOpen($i+1, $j) 		? ($i+1)*$this->N + $j 		: null );
		$neighbours[] = ( $this->isOpen($i, $j - 1) 	? $i*$this->N + ($j - 1) 	: null );
		$neighbours[] = ( $this->isOpen($i, $j + 1) 	? $i*$this->N + ($j + 1) 	: null );

//		echo '<pre>';
//		print_r(
//			[
//				'$i' => $i,
//				'$j' => $j,
//				'top' => [
//					'$i-1' => $i-1,
//					'$j' => $j,
//					'is open' => $this->isOpen($i-1, $j),
//					($i-1)*$this->N + $j
//				],
//				'bottom' => [
//					'$i+1' => $i+1,
//					'$j' => $j,
//					'is open' => $this->isOpen($i+1, $j),
//					($i+1)*$this->N + $j
//				],
//				'left' => [
//					'$i-1' => $i,
//					'$j' => $j-1,
//					'is open' => $this->isOpen($i, $j - 1),
//					($i)*$this->N + $j -1
//				],
//				'right' => [
//					'$i+1' => $i,
//					'$j' => $j+1,
//					'is open' => $this->isOpen($i, $j+1),
//					($i)*$this->N + $j+1
//				]
//			]
//		);


		$neighbours = array_filter( $neighbours, function($item){
				return ! is_null($item);
			});

//		print_r($neighbours);
//		echo '</pre>';
		return $neighbours;
	}
}