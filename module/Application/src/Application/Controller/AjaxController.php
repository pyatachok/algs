<?php
namespace Application\Controller;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */




use Application\Form\UFForm;
use Zend\View\Model\ViewModel;
use Application\Services\DynamicConectivityClient;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;

class AjaxController extends AbstractActionController
{

	public function setConnectionsAction ()
	{
		$request = $this -> getRequest ();
		if ( $request -> isPost () )
		{
			return $this->getResponse()->setContent(Json::encode([
				'yo' => 'yo',
			]));
			return new JsonModel (
					[
				'yo' => 'yo',
			] );
			
			$dc = new DynamicConectivityClient();

			return new JsonModel (
					[
				'size' => $dc -> getSizeN (),
				'connections' => $dc -> getConnections (),
				'output' => $dc -> getOutput (),
				'form' => new UFForm(),
			] );
		}
		
		// Redirect to list of albums
		return $this->redirect()->toRoute('uf');

	}

	public function indexAction ()
	{
		return new JsonModel([]);
	}

}
