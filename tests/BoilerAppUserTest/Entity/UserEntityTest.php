<?php
namespace BoilerAppUserTest\Entity;
class UserEntityTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{

	protected $userEntity;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$this->userEntity = new \BoilerAppUser\Entity\UserEntity();
	}

	public function testSetUserAuthAccess(){
		$this->assertEquals($this->userEntity,$this->userEntity->setUserAuthAccess(new \BoilerAppAccessControl\Entity\AuthAccessEntity()));
	}
}