<?php
namespace BoilerAppUserTest\View\Helper;
class UserAvatarHelperTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{

	/**
	 * @var \BoilerAppUser\View\Helper\UserAvatarHelper
	 */
	protected $userAvatarHelper;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$this->userAvatarHelper = new \BoilerAppUser\View\Helper\UserAvatarHelper();

		//Remove default avatar for tests
		rename(getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/default-avatar.png',getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/default-avatar.png.tmp');
	}

	/**
	 * @expectedException LogicException
	 */
	public function testInvokeDefaultAvatarDoesNotExist(){
		$oUser = new \BoilerAppUser\Entity\UserEntity();
		$oReflectionClass = new \ReflectionClass('BoilerAppUser\Entity\UserEntity');
		$oUserId = $oReflectionClass->getProperty('user_id');
		$oUserId->setAccessible(true);
		$oUserId->setValue($oUser, 2);
		$this->userAvatarHelper->__invoke($oUser);
	}

	public function tearDown(){
		//Restore default avatar
		rename(getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/default-avatar.png.tmp',getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/default-avatar.png');
	}
}