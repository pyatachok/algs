<?php

namespace Application\Form;


use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\Digits;
use Zend\Validator\Regex;


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
							'name' => 'Digits',
						]

					]
		] );
		$this -> add (
				[
					'name' => 'connections',
					'required' => true,
					'validators' => [
						[
							'name' => 'Regex',

							'options' => [
								'pattern' => '/^([0-9]+,[0-9]+;?)+$/',
								'messages' => [
									Regex::NOT_MATCH => 'Should be like: 0,0;1,1;'
								]
							]
						]
					]
				]
		);
	}

}
