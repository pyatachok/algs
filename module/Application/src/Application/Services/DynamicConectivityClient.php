<?php

namespace Application\Services;

use Application\UF\QuickFind;
use Application\UF\QuickUnion;
use Application\UF\QuickUnionWithPathCompression;
use Application\UF\WeightedQuickUnion;



class DynamicConectivityClient
{
	/**
	 * массив соединений $p, $q  из файла
	 * @var array
	 */
	private $connections = [];

	/**
	 * Количество звений
	 * @var int
	 */
	private $sizeN = 0;


	/**
	 * @var array
	 */
	private $output = [];

	/**
	 * Читает данные из файла, где первая строка - размер матрицы
	 * вторая и последующие - соединения.
	 * @param string $inputFile
	 */
	public function __construct($inputFile = 'public/txt/w1.txt' )
	{
		error_reporting(E_ALL); ini_set('display_errors', 1);
		$fileHandle = fopen($inputFile, 'r');
		if ( $fileHandle)
		{
			$this->sizeN = (int) fgets($fileHandle);
			$index = 0;
			$ufClient = new QuickFind($this->getSizeN());

			while ( ( $buffer = fgets($fileHandle, 1024)) !== false)
			{
				$buffer = trim($buffer);
				if ( ! empty(  $buffer  ) )
				{
					$this->connections[$index] = explode(' ', $buffer);

					$p = (int) $this->connections[$index][0];
					$q = (int) $this->connections[$index][1];

					if ( !$ufClient->connected($p, $q) )
					{
						$ufClient->union($p, $q);
					}
					$index++;
				}
			}
			$this->output = $ufClient->getIdArray();

			if (!feof($fileHandle)) {

				echo "Error: unexpected fgets() fail\n";
			}
			fclose($fileHandle);
		}
		else
		{
			echo "Error: could not open {$inputFile}\n";
		}


	}


	/**
	 * Возвращает результат выполнения
	 * @return array
	 */
	public function getOutput()
	{

		return $this->output;
	}








	/**
	 * Getters && Setters
	 */

	/**
	 * возвращает массив соединений из файла
	 * @return array
	 */
	public function getConnections ()
	{
		return $this->connections;
	}


	/**
	 * возвращает количество звений
	 * @return int
	 */
	public function getSizeN ()
	{
		return $this->sizeN;
	}

}