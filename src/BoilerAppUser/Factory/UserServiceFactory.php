<?php
namespace BoilerAppUser\Factory;
class UserServiceFactory implements \Zend\ServiceManager\FactoryInterface{
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$oUserService = new \BoilerAppUser\Service\UserService();
		return $oUserService->setServiceLocator($oServiceLocator);
    }
}