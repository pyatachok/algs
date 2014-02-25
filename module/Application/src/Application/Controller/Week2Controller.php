<?php

/**
 * Created by mice
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Controller;

use Application\Services\StacksClient;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class Week2Controller extends AbstractActionController
{
	public function indexAction()
	{
		return new ViewModel();
	}

	public function stacksAction()
	{
		$stackClient = new StacksClient();
		return new ViewModel([
			'out'
		]);
	}

	public function queriesAction()
	{
		return new ViewModel();
	}
}