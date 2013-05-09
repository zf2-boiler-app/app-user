<?php
namespace BoilerAppAccessControl\Factory;
class ChangeAvatarFormFactory implements \Zend\ServiceManager\FactoryInterface{

	/**
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
	 * @return \BoilerAppAccessControl\Form\ChangeAvatar
	 */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$oForm = new \BoilerAppUser\Form\ChangeUserAvatarForm('change_avatar');
		return $oForm->setInputFilter(new \BoilerAppUser\InputFilter\ChangeAvatarInputFilter())->prepare();
    }
}