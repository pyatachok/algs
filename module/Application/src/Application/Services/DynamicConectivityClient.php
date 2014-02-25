<?php

namespace Application\Services;

use Application\UF\QuickFind;
use Application\UF\QuickUnion;
use Application\UF\QuickUnionWithPathCompression;
use Application\UF\WeightedQuickUnion;



class DynamicConectivityClient
{
	/**
	 * Выбранный класс алгоритма.
	 */
	private $algorithmClass = 'QuickFind';

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

	private $algorithmClasses = [
		'QuickFind' => 'Application\UF\QuickFind',
		'QuickUnion' => 'Application\UF\QuickUnion',
		'QuickUnionWithPathCompression' => 'Application\UF\QuickUnionWithPathCompression',
		'WeightedQuickUnion' => 'Application\UF\WeightedQuickUnion',
	];

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
		if ( $fileHandle = fopen($inputFile, 'r'))
		{
			$this->algorithmClass =  (string) trim(fgets($fileHandle)) ;
			$this->sizeN = (int) fgets($fileHandle);
			$index = 0;
			if( !class_exists($this->algorithmClasses[$this->algorithmClass]))
			{
				$this->algorithmClass = 'QuickFind';
				echo 'Sorry could not find algorithm';
			}
			$ufClient = new $this->algorithmClasses[$this->algorithmClass] ($this->getSizeN());

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

				echo "Error: unexpected fgets() fail";
			}
			fclose($fileHandle);
		}
		else
		{
			echo "Error: could not open {$inputFile}";
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

	/**
	 * @return string
	 */
	public function getAlgorithmClass()
	{
		$return = preg_replace('/([A-Z])/', ' $1', $this->algorithmClass);

		return $return;
	}

}