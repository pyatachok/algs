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
		$size = 5;
		error_reporting(E_ALL); ini_set('display_errors', 1);
		$percolationClient = new Percolation($size);

		$percolationClient->open(0,1);
		$percolationClient->open(1,1);
		$percolationClient->open(2,1);
		$percolationClient->open(2,2);
		$percolationClient->open(3,5);
		$percolationClient->open(0,4);
		$percolationClient->open(4,0);
		$percolationClient->open(3,0);
		$percolationClient->open(4,1);
		$percolationClient->open(2,0);


        return new ViewModel([
			'size' =>  $size,
			'sites' => $percolationClient->draw(),
			'percolates' => $percolationClient->percolates(),
		]);
    }



}

