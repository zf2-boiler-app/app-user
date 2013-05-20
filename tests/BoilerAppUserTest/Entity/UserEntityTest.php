<?php
namespace BoilerAppUserTest\Entity;
class UserEntityTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{

	/**
	 * @var \BoilerAppUser\Entity\UserEntity
	 */
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

	public function testGetUserAuthAccess(){
		$oAuthAccessEntity = new \BoilerAppAccessControl\Entity\AuthAccessEntity();
		$this->assertEquals($oAuthAccessEntity,$this->userEntity->setUserAuthAccess($oAuthAccessEntity)->getUserAuthAccess());
	}

	public function testGetUserEmail(){
		$oAuthAccessEntity = new \BoilerAppAccessControl\Entity\AuthAccessEntity();
		$this->assertEquals('test@test.com',$this->userEntity->setUserAuthAccess($oAuthAccessEntity->setAuthAccessEmailIdentity('test@test.com'))->getUserEmail());
	}
}