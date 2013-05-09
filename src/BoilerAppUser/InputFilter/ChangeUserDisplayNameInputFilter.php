<?php
namespace BoilerAppUser\InputFilter;
class ChangeUserDisplayNameInputFilter extends \Zend\InputFilter\InputFilter{
	/**
	 * Constructor
	 */
    public function __construct(){
    	$this->add(array(
			'name' => 'user_display_name',
			'required' => true
		));
    }
}