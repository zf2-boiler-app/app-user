<?php
namespace BoilerAppUserTest\Service;
class UserServiceTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractDoctrineTestCase{

	/**
	 * @var \BoilerAppUser\Service\UserService
	 */
	protected $userService;

	/**
	 * @see \BoilerAppTest\PHPUnit\TestCase\AbstractDoctrineTestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$this->userService = new \BoilerAppUser\Service\UserService();
		$this->userService->setServiceLocator($this->getServiceManager());
	}

	public function testGetAvailableUserDisplayName(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		//Available
		$this->assertEquals('test', $this->userService->getAvailableUserDisplayName('test'));

		//Unavailable (using nice generator)
		$this->assertRegExp('/^valid[0-9]{4}$/', $this->userService->getAvailableUserDisplayName('valid'));

		//Fail until 15 attempts (using hard generator)
		$this->userService = new \BoilerAppUserTest\Service\UserServiceAvaillableDisplayNameFailedUntil15Attempts();
		$this->userService->setServiceLocator($this->getServiceManager());
		$this->assertRegExp('/^valid[a-f0-9]{13}$/', $this->userService->getAvailableUserDisplayName('valid'));
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testGetAvailableUserDisplayNameGeneratorFailed(){
		$this->userService = new \BoilerAppUserTest\Service\UserServiceAvaillableDisplayNameFailed();
		$this->userService->setServiceLocator($this->getServiceManager());
		$this->userService->getAvailableUserDisplayName('valid');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testGetAvailableUserDisplayNameWithWrongDisplayName(){
		$this->userService->getAvailableUserDisplayName(null);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testIsUserDisplayNameAvailableWithWrongDisplayName(){
		$this->userService->isUserDisplayNameAvailable(null);
	}
}