<?php
namespace BoilerAppUser\Form;
class ChangeUserAvatarForm extends \BoilerAppDisplay\Form\AbstractForm{

	/**
	 * Constructor
	 * @param string $sName
	 * @param array $aOptions
	 */
	public function __construct($sName = null,$aOptions = null){
		parent::__construct($sName,$aOptions);
		$this->add(array(
			'name' => 'new_user_avatar',
			'type' => 'Zend\Form\Element\File',
			'attributes' => array(
				'required' => true,
				'class' => 'required validate-file-extension:\'png,jpg,gif,jpeg\'',
				'autofocus' => 'autofocus'
			),
			'options' => array(
				'label' => 'avatar'
			)
		))
		->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'value' => 'change_avatar',
				'class' => 'btn-large btn-primary'
			),
			'options' => array('twb'=>array('formAction' => true))
		));
	}
}