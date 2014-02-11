<?php

namespace Application\Form;


use Zend\Form\Form;

/**
 * Description of UFForm
 *
 * @author pyatachok
 */
class UFForm extends Form
{

	public function __construct ()
	{
		parent::__construct ( 'UFform' );

		$this -> setAttribute ( 'action', '/ajax/setConnections' );
		$this -> setAttribute ( 'method', 'post' );
		$this -> setInputFilter ( new UFInputFilter () );

		$this -> add ( array (
			'name' => 'size',
			'options' => array (
				'label' => 'Size',
			),
			'type' => 'Text',
		) );
		$this -> add ( array (
			'name' => 'connections',
			'options' => array (
				'label' => 'Connections',
			),
			'type' => 'Text',
		) );
		$this -> add ( array (
			'name' => 'send',
			'type' => 'Submit',
			'attributes' => array (
				'value' => 'Submit',
			),
		) );
	}

}
