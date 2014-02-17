<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\UF\Percolation\Percolation;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PercolationController extends AbstractActionController
{
    public function indexAction()
    {
		$memoryStart = memory_get_usage(true);
		$startTime = microtime(true);
		$size = $this->params() -> fromQuery ('size', 5);
		$percolationClient = new Percolation($size);
		$percolations = [];

		while ( false === $percolationClient->percolates() )
		{
			$randomI = rand(0, $size-1);
			$randomJ = rand(0, $size-1);
			$percolationClient->open($randomI, $randomJ);

			$percolations[] = [
				'openNow' => $randomI*$size+$randomJ,
				'sites' => $percolationClient->draw(),
				'percolates' => $percolationClient->percolates(),
			];
		}
		$endTime = microtime(true);

		$memoryStop = memory_get_usage(true);
        return new ViewModel([
			'size' =>  $size,
			'percolations' => $percolations,
			'timeDelta' => $endTime - $startTime,
			'memoryUsage' =>[
				'start' => $memoryStart,
				'stop' => $memoryStop,
				'delta' => $memoryStop - $memoryStart
			]

		]);
    }



}

