<?php
namespace BoilerAppUser\Form;
class ChangeUserDisplayNameForm extends \BoilerAppDisplay\Form\AbstractForm{

	/**
	 * Constructor
	 * @param string $sName
	 * @param array $aOptions
	 */
	public function __construct($sName = null,$aOptions = null){
		parent::__construct($sName,$aOptions);
		$this->add(array(
			'name' => 'new_user_display_name',
			'attributes' => array(
				'required' => true,
				'class' => 'required displayNameIsAvailable',
				'autofocus' => 'autofocus',
				'onchange' => 'oController.checkDisplayNameAvailability(document.id(this));',
				'autocomplete' => 'off'
			),
			'options' => array(
				'label' => 'display_name'
			)
		))
		->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'value' => 'change_display_name',
				'class' => 'btn-large btn-primary'
			),
			'options' => array('twb'=>array('formAction' => true))
		));
	}
}