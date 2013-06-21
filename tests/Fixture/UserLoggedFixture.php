<?php
namespace BoilerAppUserTest\Fixture;
class UserLoggedFixture extends \BoilerAppTest\Doctrine\Common\DataFixtures\AbstractFixture{
	public function load(\Doctrine\Common\Persistence\ObjectManager $oObjectManager){
		$oBCrypt = new \Zend\Crypt\Password\Bcrypt();
		$oAccessControlService = $this->getServiceLocator()->get('AccessControlService');

		//Valid authentication
		$oAuthAccessEntity = new \BoilerAppAccessControl\Entity\AuthAccessEntity();
		$oObjectManager->persist($oAuthAccessEntity
			->setAuthAccessEmailIdentity('valid@test.com')
			->setAuthAccessUsernameIdentity('valid')
			->setAuthAccessCredential($oBCrypt->create(md5('valid-credential')))
			->setAuthAccessState(\BoilerAppAccessControl\Repository\AuthAccessRepository::AUTH_ACCESS_ACTIVE_STATE)
			//Not randomly generated key to be able to compare during testing
			->setAuthAccessPublicKey($oBCrypt->create('bc4b775da5e0d05ccbe5fa1c14'))
			->setEntityCreate(new \DateTime())
		);

		$oValidUser =  new \BoilerAppuser\Entity\UserEntity();
		$oObjectManager->persist($oValidUser
			->setUserDisplayName('Valid')
			->setEntityCreate(new \DateTime())
			->setUserAuthAccess($oAuthAccessEntity)
		);


		//Another valid authentication
		$oAuthAccessEntity = new \BoilerAppAccessControl\Entity\AuthAccessEntity();
		$oObjectManager->persist($oAuthAccessEntity
			->setAuthAccessEmailIdentity('valid1@test.com')
			->setAuthAccessUsernameIdentity('valid1')
			->setAuthAccessCredential($oBCrypt->create(md5('valid-credential')))
			->setAuthAccessState(\BoilerAppAccessControl\Repository\AuthAccessRepository::AUTH_ACCESS_ACTIVE_STATE)
			//Not randomly generated key to be able to compare during testing
			->setAuthAccessPublicKey($oBCrypt->create('bc4b775da5e0d05ccbe5fa1c14'))
			->setEntityCreate(new \DateTime())
		);

		$oValidUser =  new \BoilerAppuser\Entity\UserEntity();
		$oObjectManager->persist($oValidUser
			->setUserDisplayName('Valid1')
			->setEntityCreate(new \DateTime())
			->setUserAuthAccess($oAuthAccessEntity)
		);

		//Flush data
		$oObjectManager->flush();
	}
}