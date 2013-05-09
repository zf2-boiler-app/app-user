<?php
namespace BoilerAppUser\InputFilter;
class ChangeUserAvatarInputFilter extends \Zend\InputFilter\InputFilter{
	/**
	 * Constructor
	 */
    public function __construct(){
    	$this->add(array(
			'name' => 'user_new_avatar',
			'required' => true
		));
    }
}