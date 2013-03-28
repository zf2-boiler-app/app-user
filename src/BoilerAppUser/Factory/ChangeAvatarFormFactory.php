<?php
namespace BoilerAppUser\Factory;
class ChangeAvatarFormFactory implements \Zend\ServiceManager\FactoryInterface{
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$oForm = new \BoilerAppUser\Form\ChangeAvatarForm();
		return $oForm->prepare();
    }
}