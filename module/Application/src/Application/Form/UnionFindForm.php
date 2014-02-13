<?php

/**
 * Created by mice
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Form;

use Zend\Form\Form;

class UnionFindForm extends  Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('album');
		$this->setAttribute('method', 'post');

		$this->add(array(
			'name' => 'size',
			'attributes' => array(
				'type'  => 'text',
			),
			'options' => array(
				'label' => 'Size',
			),
		));
		$this->add(array(
			'name' => 'connections',
			'attributes' => array(
				'type'  => 'text',
			),
			'options' => array(
				'label' => 'Connections',
			),
		));
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'value' => 'Go',
				'id' => 'submitbutton',
			),
		));
	}
}