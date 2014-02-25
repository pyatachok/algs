<?php

namespace Application\Services;

use Application\Model\Stack;


class StacksClient
{

	private $out = '';
	/**
	 * @var array
	 */
	private $output = [];

	/**
	 * Читает данные из файла, где первая строка - размер матрицы
	 * вторая и последующие - соединения.
	 * @param string $inputFile
	 */
	public function __construct($inputFile = 'public/txt/w2/stack.txt' )
	{
		if ( $fileHandle = fopen($inputFile, 'r'))
		{

			$this->out = '';
			$stack = new Stack();
			while ( ( $buffer = fgets($fileHandle, 1024)) !== false)
			{
				$buffer = trim($buffer);
				if ( ! empty(  $buffer  ) )
				{
					if ( '-' === $buffer )
					{
						$this->out = $stack->pop();
					}
					else
					{
						$stack->push($buffer);
					}
				}
			}

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
	 * @return string
	 */
	public function getOut()
	{
		return $this->out;
	}


}