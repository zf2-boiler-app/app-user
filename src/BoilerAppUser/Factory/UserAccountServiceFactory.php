<?php
namespace BoilerAppUser\Factory;
class UserAccountServiceFactory implements \Zend\ServiceManager\FactoryInterface{
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$oUserService = new \BoilerAppUser\Service\UserAccountService();
		return $oUserService->setServiceLocator($oServiceLocator);
    }
}