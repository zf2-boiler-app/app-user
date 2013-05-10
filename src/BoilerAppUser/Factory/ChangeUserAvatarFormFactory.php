<?php
namespace BoilerAppUser\Factory;
class ChangeUserAvatarFormFactory implements \Zend\ServiceManager\FactoryInterface{

	/**
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
	 * @return \BoilerAppUser\Form\ChangeUserAvatarForm
	 */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$oForm = new \BoilerAppUser\Form\ChangeUserAvatarForm('change_user_avatar');
		return $oForm->setInputFilter(new \BoilerAppUser\InputFilter\ChangeUserAvatarInputFilter())->prepare();
    }
}