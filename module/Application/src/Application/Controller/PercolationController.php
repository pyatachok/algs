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
		error_reporting(E_ALL); ini_set('display_errors', 1);
		$percolationClient = new Percolation(3);

		$percolationClient->open(0,1);
		$percolationClient->open(1,1);
		$percolationClient->open(2,1);


        return new ViewModel([
			'sites' => $percolationClient->draw(),
			'percolates' => $percolationClient->percolates(),
		]);
    }



}

