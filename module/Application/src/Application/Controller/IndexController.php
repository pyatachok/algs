<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\UFForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Services\DynamicConectivityClient;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

	public function ufAction()
	{
		$form = new UFForm();
		$dc = new DynamicConectivityClient();

		return new ViewModel(
			[
			'size' 			=> $dc->getSizeN(),
			'connections' 	=> $dc->getConnections(),
			'output' 		=> $dc->getOutput(),
			'form'			=> new UFForm(),

		]);
	}

}

