<?php

namespace Application\Form;


use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\Digits;

/**
 * Description of UFInputFilter
 *
 * @author pyatachok
 */
class UFInputFilter extends InputFilter
{

	public function __construct ()
	{
		$this -> add (
				[
					'name' => 'size',
					'required' => true,
					'validators' => [
						[
							'name' => 'NotEmpty',
						]
					]
		] );
		$this -> add (
				[
					'name' => 'connections',
					'required' => true,
					'validators' => [
						[
							'name' => 'Digits',
						]
					]
				]
		);
	}

}
