<?php
namespace BoilerAppUserTest\Service;
class UserServiceAvaillableDisplayNameFailed extends \BoilerAppUser\Service\UserService{

	/**
	 * @see \BoilerAppUser\Service\UserService::isUserDisplayNameAvailable()
	 */
	public function isUserDisplayNameAvailable($sUserDisplayName){
		return false;
	}
}