<?php namespace App\Services\Validation;

use Illuminate\Validation\Validator;

class AlphaNumSpaces extends Validator {
	
	private $_custom_messages = array(
		'alpha_dash_spaces' => 'The :attribute may only contain letters, spaces, and dashes.',
		'alpha_num_spaces' => 'The :attribute may only contain letters, numbers, and spaces.',
		'alpha_num_dash' => 'The :attribute may only contain letters, numbers, and spaces.',
		'alpha_num_dash_spaces' => 'The :attribute may only contain letters, numbers, dashes, and spaces.',
		'num_dash' => 'The :attribute may only contain letters and dashes'
	);
	
	public function __construct($translator, $data, $rules, $messages = array(), $customAttributes = array())
	{
		parent::__construct( $translator, $data, $rules, $messages, $customAttributes );
		$this->setCustomMessages( $this->_custom_messages );
	}
	
	public function validateAlphaDashSpaces( $attribute, $value )
	{
		return (bool) preg_match( "/^[\p{L}\p{Mn}\s-_]+$/u", $value );
	}
	
	public function validateAlphaNumSpaces( $attribute, $value )
	{
		return (bool) preg_match( "/^[\p{L}\p{Mn}0-9\s]+$/u", $value );
	}

	public function validateAlphaNumDash( $attribute, $value )
	{
		return (bool) preg_match( "/^[\p{L}\p{Mn}0-9\s-_]+$/u", $value );
	}

	public function validateAlphaNumDashSpaces( $attribute, $value )
	{
		return (bool) preg_match( "/^[\p{L}\p{Mn}0-9\s-_ ]+$/u", $value );
	}

	public function validateNumDash($attribute, $value)
	{
		return (bool) preg_match( "/^[0-9-]+$/u");
	}
	
}
