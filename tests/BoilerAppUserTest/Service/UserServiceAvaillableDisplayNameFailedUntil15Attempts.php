<?php
namespace BoilerAppUserTest\Service;
class UserServiceAvaillableDisplayNameFailedUntil15Attempts extends \BoilerAppUser\Service\UserService{
	private static $attempts = 0;

	/**
	 * @see \BoilerAppUser\Service\UserService::isUserDisplayNameAvailable()
	 */
	public function isUserDisplayNameAvailable($sUserDisplayName){
		self::$attempts++;
		return self::$attempts < 15?false:parent::isUserDisplayNameAvailable($sUserDisplayName);
	}
}