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
		$this -> setAttributes([
			'role' 		=> 'form',
			'class'		=> 'form-horizontal uf-form'
		]);

		$this -> add ( array (
			'name' => 'size',
			'options' => array (
				'label' => 'Size',
			),
			'type' => 'Text',
			'attributes' => [
				'id' => 'uf-size',
				'data-toggle' => "popover",
				'data-placement' =>"right",
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
				'id' => 'uf-connections',
				'data-toggle' => "popover",
				'data-placement' =>"right",
				'data-content' => ""
			],
		) );
		$this->add(array(
			'name' => 'algorithm',
			'type' => 'Radio',
			'options' => [
				'label' => 'Chose Atgorithm',
				'value_options' => [
					'QuickFind' => 'Quick Find',
					'QuickUnion' => 'Quick Union',
					'QuickUnionWithPathCompression' => 'Quick Union With Path Compression',
					'WeightedQuickUnion' => 'Weighted Quick Union'

				],
			],
			'attributes' => [
				'class' => 'uf-radio'
			]
			));
		$this -> add ( array (
			'name' => 'send',
			'type' => 'Submit',
			'attributes' => array (
				'value' => 'Submit',
			),
		) );
	}

}
