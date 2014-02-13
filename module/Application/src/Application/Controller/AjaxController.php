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
use Zend\Http\Request;

class AjaxController extends AbstractActionController
{

	public function setConnectionsAction ()
	{
		/**
		 * @var Request $request
		 */
		$request = $this -> getRequest ();
		if ( $request -> isPost () )
		{
			$form = new UFForm();

			$form->setData($request->getPost());

			if ( $form->isValid() )
			{
				$size = $this->params()->fromPost('size', 0);
				$connectionsStr = $this->params()->fromPost('connections', '');
				$connections = array_map(function ($item){
					return explode(',', $item);
				}, explode(';', $connectionsStr));

				$inputFile = 'public/txt/w1.txt';
				if ( $fileHandle = fopen($inputFile, 'w'))
				{

					fwrite($fileHandle, $size . "\n");
					foreach ( $connections as $connection)
					{
						fwrite($fileHandle, implode(' ', $connection) . "\r\n");
					}

					fclose($fileHandle);
				}

				return $this->getResponse()->setContent(Json::encode([
					'reload' => true,
				]));
 			}
			else
			{
				return $this->getResponse()->setContent(Json::encode([
					'errors' => $form->getMessages(),
				]));
			}
		}

		// Redirect to list of albums
		return $this->redirect()->toRoute('uf');

	}

	public function indexAction ()
	{
		return new JsonModel([]);
	}

}
