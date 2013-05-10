<?php
namespace BoilerAppUser\InputFilter;
class ChangeUserAvatarInputFilter extends \Zend\InputFilter\InputFilter{
	/**
	 * Constructor
	 */
    public function __construct(){
    	$this->add(array(
			'name' => 'new_user_avatar',
			'required' => true,
    		'validators' => array(
    			array(
    				'name' => 'Zend\Validator\File\Extension',
    				'options' => array('extension' => array('png','jpg','gif','jpeg'))
    			)
    		)
		));
    }
}