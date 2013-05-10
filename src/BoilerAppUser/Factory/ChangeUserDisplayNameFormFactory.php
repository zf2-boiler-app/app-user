<?php
namespace BoilerAppUser\Factory;
class ChangeUserDisplayNameFormFactory implements \Zend\ServiceManager\FactoryInterface{
	/**
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
	 * @return \BoilerAppUser\Form\ChangeUserDisplayNameForm
	 */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$oForm = new \BoilerAppUser\Form\ChangeUserDisplayNameForm('change_user_display_name');
		return $oForm->setInputFilter(
			new \BoilerAppUser\InputFilter\ChangeUserDisplayNameInputFilter($oServiceLocator->get('BoilerAppUser\Repository\UserRepository'))
		)->prepare();
    }
}