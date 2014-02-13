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
		$this -> setAttribute('role', 'form');

		$this -> add ( array (
			'name' => 'size',
			'options' => array (
				'label' => 'Size',
			),
			'type' => 'Text',
			'attributes' => [
				'data-toggle' => "popover",
				'data-placement' =>"top",
				'data-content' => ""
			],
		) );
		$this -> add ( array (
			'name' => 'connections',
			'options' => array (
				'label' => 'Connections',
			),
			'type' => 'Text',
			'attributes' => [
				'data-toggle' => "popover",
				'data-placement' =>"top",
				'data-content' => ""
			],
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
