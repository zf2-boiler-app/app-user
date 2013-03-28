<?php
namespace BoilerAppUser\Factory;
class ChangePasswordFormFactory implements \Zend\ServiceManager\FactoryInterface{
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$oForm = new \BoilerAppUser\Form\ChangePasswordForm(null,array(
			'translator' => $oServiceLocator->get('translator'),
			'checkUserLoggedPassword' => array($oServiceLocator->get('UserAccountService'),'checkUserLoggedPassword')
		));
		return $oForm->prepare();
    }
}