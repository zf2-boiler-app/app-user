<?php
namespace BoilerAppUser\Factory;
class UserAvatarHelperFactory implements \Zend\ServiceManager\FactoryInterface{
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
		$aConfiguration = $oServiceLocator->getServiceLocator()->get('Config');
		if(!isset($aConfiguration['paths']['avatarsPath']))throw new \LogicException('Avatars path configuration is undefined');
		$oUserAvavatarHelper = new \BoilerAppUser\View\Helper\UserAvatarHelper();
		return $oUserAvavatarHelper->setAvatarsPath($aConfiguration['paths']['avatarsPath']);
    }
}