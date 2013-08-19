<?php
namespace BoilerAppUserTest\Service;
class UserAccountServiceTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractDoctrineTestCase{

	/**
	 * @var \BoilerAppUser\Service\UserAccountService
	 */
	protected $userAccountService;

	/**
	 * @see \BoilerAppTest\PHPUnit\TestCase\AbstractDoctrineTestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$this->userAccountService = new \BoilerAppUser\Service\UserAccountService();
		$this->userAccountService->setServiceLocator($this->getServiceManager());
	}

	public function testChangeAuthenticatedUserAvatar(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		//Remove avatar if exists
		$sAvatarPath = getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/1-avatar.png';
		if(file_exists($sAvatarPath))unlink($sAvatarPath);

		$this->userAccountService->changeAuthenticatedUserAvatar(getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/1.png');
		$this->assertFileExists($sAvatarPath);
		unlink($sAvatarPath);

		$this->userAccountService->changeAuthenticatedUserAvatar(getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/1.jpg');
		$this->assertFileExists($sAvatarPath);
		unlink($sAvatarPath);

		$this->userAccountService->changeAuthenticatedUserAvatar(getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/1.gif');
		$this->assertFileExists($sAvatarPath);
		unlink($sAvatarPath);
	}

	/**
	 * @expectedException DomainException
	 */
	public function testChangeAuthenticatedUserAvatarWithWrongFileType(){
		$this->userAccountService->changeAuthenticatedUserAvatar(getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/1.tif');
	}
}