<?php
namespace BoilerAppUser\Factory;
class ChangeEmailFormFactory implements \Zend\ServiceManager\FactoryInterface{
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$oForm = new \BoilerAppUser\Form\ChangeEmailForm(null,array(
			'translator' => $oServiceLocator->get('translator'),
			'userEmail' => $oServiceLocator->get('AccessControlService')->getLoggedUser()->getUserEmail(),
			'checkUserEmailAvailability' => array($oServiceLocator->get('UserModel'),'isUserEmailAvailable')
		));
		return $oForm->prepare();
    }
}