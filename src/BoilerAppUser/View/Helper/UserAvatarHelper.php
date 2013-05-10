<?php
namespace BoilerAppUser\View\Helper;
class UserAvatarHelper extends \Zend\View\Helper\AbstractHelper{
	/**
	 * @var string
	 */
	protected $avatarsPath;

	/**
	 * @param string $sAvatarsPath
	 * @throws \InvalidArgumentException
	 * @return \BoilerAppUser\View\Helper\UserAvatarHelper
	 */
	public function setAvatarsPath($sAvatarsPath){
		if(!is_string($sAvatarsPath))throw new \InvalidArgumentException('Avatars path expects a string, "'.gettype($sAvatarsPath).'" given');
		if(!is_dir($sAvatarsPath))throw new \InvalidArgumentException('Avatars path "'.$sAvatarsPath.'" is not a valid directory');
		$this->avatarsPath = realpath($sAvatarsPath);
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return string
	 */
	public function getAvatarsPath(){
		if(!$this->avatarsPath)throw new \LogicException('Avatars path is undefined');
		return $this->avatarsPath;
	}

	/**
	 * Retrieve avatar image content in base64 encoding
	 * @param \BoilerAppUser\Entity\UserEntity $oUser
	 * @throws \LogicException
	 * @return string
	 */
	public function __invoke(\BoilerAppUser\Entity\UserEntity $oUser){
		if(!file_exists($sAvatarPath = $this->getAvatarsPath().DIRECTORY_SEPARATOR.$oUser->getUserId().'-avatar.png')){
			if(!file_exists($sAvatarPath = $this->getAvatarsPath().DIRECTORY_SEPARATOR.'default-avatar.png'))throw new \LogicException('Default avatar "'.$sAvatarPath.'" does not exist');
		}
		return base64_encode(file_get_contents($sAvatarPath));
	}
}