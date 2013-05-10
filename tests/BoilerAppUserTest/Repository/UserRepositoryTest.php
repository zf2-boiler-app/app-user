<?php
namespace BoilerAppUserTest\Repository;
class UserRepositoryTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{

	protected $userRepository;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$this->userRepository = $this->getServiceManager()->get('BoilerAppUser\Repository\UserRepository');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testIsUserDisplayNameAvailableWithWrongDisplayName(){
		$this->userRepository->isUserDisplayNameAvailable(null);
	}
}