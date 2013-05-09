<?php
namespace BoilerAppUser\Form;
class ChangeAvatarForm extends \BoilerAppDisplay\Form\AbstractForm{

	/**
	 * Constructor
	 * @param string $sName
	 * @param array $aOptions
	 * @throws \Exception
	 */
	public function __construct($sName = null,$aOptions = null){
		parent::__construct($sName,$aOptions);
		$this->add(array(
			'name' => 'user_display_name',
			'attributes' => array(
				'required' => true,
				'class' => 'required',
				'autofocus' => 'autofocus'
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