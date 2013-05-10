<?php
namespace BoilerAppUser\InputFilter;
class ChangeUserDisplayNameInputFilter extends \Zend\InputFilter\InputFilter{
	/**
	 * Constructor
	 */
    public function __construct(\BoilerAppUser\Repository\UserRepository $oUserRepository){
    	$this->add(array(
			'name' => 'new_user_display_name',
			'required' => true,
			'validators' => array(
				array(
					'name'=> 'BoilerAppUser\Validator\DisplayNameAvailabilityValidator',
					'options' => array(
						'checkAvailabilityCallback' => array($oUserRepository, 'isUserDisplayNameAvailable')
					)
				)
			)
		));
    }
}