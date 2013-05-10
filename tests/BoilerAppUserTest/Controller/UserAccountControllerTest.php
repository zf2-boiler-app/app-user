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

		$this->dispatch('/user/delete-account');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/DeleteAccount');
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

		$this->dispatch('/user/change-avatar');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/ChangeAvatar');
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

		$this->dispatch('/user/change-display-name');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/ChangeDisplayName');
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

		$this->dispatch('/user/change-display-name',\Zend\Http\Request::METHOD_POST,array(
			'new_user_display_name' => 'New display name'
		));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/ChangeDisplayName');

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

		$this->dispatch('/user/check-display-name-availability',\Zend\Http\Request::METHOD_POST,array(
			'display_name' => 'New display name'
		));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/CheckDisplayNameAvailability');
		$this->assertEquals('{"available":true}',$this->getResponse()->getContent());

		//Same as currently used
		$this->dispatch('/user/check-display-name-availability',\Zend\Http\Request::METHOD_POST,array(
			'display_name' => 'Valid'
		));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/CheckDisplayNameAvailability');
		$this->assertEquals(\Zend\Json\Encoder::encode(array(
			'available' => $oTranslator->translate('The display name "%value%" is the same as currently used','validator')
		)),$this->getResponse()->getContent());

		//Unavailable
		$this->dispatch('/user/check-display-name-availability',\Zend\Http\Request::METHOD_POST,array(
			'display_name' => 'Valid1'
		));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('BoilerAppUser');
		$this->assertControllerName('BoilerAppUser\Controller\UserAccount');
		$this->assertControllerClass('UserAccountController');
		$this->assertMatchedRouteName('User/CheckDisplayNameAvailability');
		$this->assertEquals(\Zend\Json\Encoder::encode(array(
			'available' => str_replace('%value%', 'Valid1', $oTranslator->translate('The display name "%value%" is unavailable','validator'))
		)),$this->getResponse()->getContent());
	}
}