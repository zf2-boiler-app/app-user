<?php
namespace BoilerAppUser\Service;
class UserAccountService implements \Zend\ServiceManager\ServiceLocatorAwareInterface{
	use \Zend\ServiceManager\ServiceLocatorAwareTrait;

	/**
	 * Create new avatar image for current authenticated user
	 * @param string $sUserAvatarFilePath
	 * @throws \InvalidArgumentException
	 * @throws \RuntimeException
	 * @throws \DomainException
	 * @throws \LogicException
	 * @return \BoilerAppUser\Service\UserAccountService
	 */
	public function changeAuthenticatedUserAvatar($sUserAvatarFilePath){
		if(!is_string($sUserAvatarFilePath))throw new \InvalidArgumentException('User avatar path expects string, "'.gettype($sUserAvatarFilePath).'" given');
		if(!is_readable($sUserAvatarFilePath))throw new \InvalidArgumentException('User avatar path "'.$sUserAvatarFilePath.'" is not a readable file path');

		if(!($aImagesInfos = @getimagesize($sUserAvatarFilePath)) || empty($aImagesInfos[2]))\RuntimeException('An error occurred while retrieving user avatar "'.$sUserAvatarFilePath.'" infos');
		switch($aImagesInfos[2]){
			case IMAGETYPE_JPEG:
				if(!$oImage = imagecreatefromjpeg($sUserAvatarFilePath))throw new \RuntimeException('An error occurred during creating image from "jpeg" user avatar "'.$sUserAvatarFilePath.'"');
				break;
			case IMAGETYPE_GIF:
				if(!$oImage = imagecreatefromgif($sUserAvatarFilePath))throw new \RuntimeException('An error occurred during creating image from "gif" user avatar "'.$sUserAvatarFilePath.'"');
				break;
			case IMAGETYPE_PNG:
				if(!$oImage = imagecreatefrompng($sUserAvatarFilePath))throw new \RuntimeException('An error occurred during creating image from "png" user avatar "'.$sUserAvatarFilePath.'"');
				break;
			default:
				throw new \DomainException('File type "'.$aImagesInfos[2].'" is not supported for avatar');
		}

		//Crop image
		if(!$oNewImage = imagecreatetruecolor(128,128))throw new \RuntimeException('An error occurred during creating new image for croping user avatar');

		if(!imagecopyresampled($oNewImage, $oImage, 0, 0, 0, 0, 128, 128, imagesx($oImage), imagesy($oImage)))throw new \RuntimeException('An error occurred during croping user avatar');

		$aConfiguration = $this->getServiceLocator()->get('Config');

		if(empty($aConfiguration['paths']['avatarsPath']))throw new \LogicException('Avatars directory path is undefined');
		if(!is_string($aConfiguration['paths']['avatarsPath']))throw new \LogicException('Avatars directory path expects string, "'.gettype($aConfiguration['paths']['avatarsPath']).'" given');
		if(!is_dir($aConfiguration['paths']['avatarsPath']))throw new \LogicException('Avatars directory path expects string, "'.$aConfiguration['paths']['avatarsPath'].'" is not a valid directory');

		//Save avatar
		if(!imagepng(
			$oNewImage,
			$aConfiguration['paths']['avatarsPath'].DIRECTORY_SEPARATOR.$this->getServiceLocator()->get('AccessControlService')->getAuthenticatedAuthAccess()->getAuthAccessUser()->getUserId().'-avatar.png'
		))throw new \RuntimeException('An error occurred during saving user avatar');
		return $this;
	}

	/**
	 * Change current authenticated user display name if available
	 * @param string $sUserDisplayName
	 * @throws \InvalidArgumentException
	 * @return \BoilerAppUser\Service\UserAccountService
	 */
	public function changeAuthenticatedUserDisplayName($sUserDisplayName){
		if(!is_string($sUserDisplayName))throw new \InvalidArgumentException('User display name expects string, "'.gettype($sUserDisplayName).'" given');
		if(empty($sUserDisplayName))throw new \InvalidArgumentException('User display name is empty');

		$oUserRepository = $this->getServiceLocator()->get('BoilerAppUser\Repository\UserRepository');

		if(!$oUserRepository->isUserDisplayNameAvailable($sUserDisplayName))throw new \InvalidArgumentException('User display name "'.$sUserDisplayName.'" is not available');
		//Update user display name
		$oUserRepository->update(
			$this->getServiceLocator()->get('AccessControlService')->getAuthenticatedAuthAccess()->getAuthAccessUser()->setUserDisplayName($sUserDisplayName)
		);

		return $this;
	}
}