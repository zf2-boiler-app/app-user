<?php
namespace BoilerAppUserTest\Controller;
class UserAccountControllerTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractHttpControllerTestCase{

	public function testAccountAction(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		//Authenticate user
		$this->getApplicationServiceLocator()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential'
		);

		$this->dispatch('/user/account');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account');
	}

	public function testDeleteAccountAction(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		//Authenticate user
		$this->getApplicationServiceLocator()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential'
		);

		$this->dispatch('/user/account/delete-account');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account/DeleteAccount');
	}

	public function testChangeAvatarAction(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		//Authenticate user
		$this->getApplicationServiceLocator()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential'
		);

		$this->getRequest()->getHeaders()->addHeaderLine('X_REQUESTED_WITH', 'XMLHttpRequest');

		$this->dispatch('/user/account/change-avatar');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account/ChangeAvatar');
	}

	public function testChangeAvatarActionPost(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		//Authenticate user
		$this->getApplicationServiceLocator()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential'
		);

		$this->getRequest()->getFiles()->set('new_user_avatar',$_FILES['new_user_avatar'] = array(
			'name' => '1.png',
			'type' => 'image/png',
    		'tmp_name' => $sAvatarPath = getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/1.png',
		    'error' => 0,
		    'size' => filesize($sAvatarPath)
		));

		//Remove file validators for tests (Phunit can't simulate file upload)
		$this->getApplicationServiceLocator()->get('ChangeUserAvatarForm')
			->setInputFilter(new \Zend\InputFilter\InputFilter())
			->getInputFilter()->remove('new_user_avatar')->add(new \Zend\InputFilter\Input(),'new_user_avatar');

		$this->dispatch('/user/account/change-avatar',\Zend\Http\Request::METHOD_POST,array());
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account/ChangeAvatar');

		$this->assertFileExists(getcwd().DIRECTORY_SEPARATOR.'tests/_files/avatars/1-avatar.png');
	}

	public function testChangeDisplayNameAction(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		//Authenticate user
		$this->getApplicationServiceLocator()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential'
		);

		$this->getRequest()->getHeaders()->addHeaderLine('X_REQUESTED_WITH', 'XMLHttpRequest');

		$this->dispatch('/user/account/change-display-name');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account/ChangeDisplayName');
	}

	public function testChangeDisplayNameActionPost(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		//Authenticate user
		$this->getApplicationServiceLocator()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential'
		);

		$this->getRequest()->getHeaders()->addHeaderLine('X_REQUESTED_WITH', 'XMLHttpRequest');

		$this->dispatch('/user/account/change-display-name',\Zend\Http\Request::METHOD_POST,array(
			'new_user_display_name' => 'New display name'
		));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account/ChangeDisplayName');

		$this->assertEquals('New display name',$this->getServiceManager()->get('AccessControlService')->getAuthenticatedAuthAccess()->getAuthAccessUser()->getUserDisplayName());
	}

	public function testCheckDisplayNameAvailabilityAction(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		$oTranslator = $this->getServiceManager()->get('translator');

		//Authenticate user
		$this->getApplicationServiceLocator()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential'
		);

		$this->getRequest()->getHeaders()->addHeaderLine('X_REQUESTED_WITH', 'XMLHttpRequest')->addHeader(\Zend\Http\Header\Accept::fromString('Accept: application/json; version=0.2'));

		$this->dispatch('/user/account/check-display-name-availability',\Zend\Http\Request::METHOD_POST,array(
			'display_name' => 'New display name'
		));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account/CheckDisplayNameAvailability');
		$this->assertEquals('{"available":true}',$this->getResponse()->getContent());

		//Same as currently used
		$this->dispatch('/user/account/check-display-name-availability',\Zend\Http\Request::METHOD_POST,array(
			'display_name' => 'Valid'
		));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account/CheckDisplayNameAvailability');
		$this->assertEquals(\Zend\Json\Encoder::encode(array(
			'available' => $oTranslator->translate('The display name "%value%" is the same as currently used','validator')
		)),$this->getResponse()->getContent());

		//Unavailable
		$this->dispatch('/user/account/check-display-name-availability',\Zend\Http\Request::METHOD_POST,array(
			'display_name' => 'Valid1'
		));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/Account/CheckDisplayNameAvailability');
		$this->assertEquals(\Zend\Json\Encoder::encode(array(
			'available' => str_replace('%value%', 'Valid1', $oTranslator->translate('The display name "%value%" is unavailable','validator'))
		)),$this->getResponse()->getContent());
	}
}