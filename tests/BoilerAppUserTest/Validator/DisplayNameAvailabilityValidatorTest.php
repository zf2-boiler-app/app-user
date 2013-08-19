<?php
namespace BoilerAppUserTest\Validator;
class DisplayNameAvailabilityValidatorTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractDoctrineTestCase{

	/**
	 * @var \BoilerAppUser\Validator\DisplayNameAvailabilityValidator
	 */
	protected $displayNameAvailabilityValidator;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$this->displayNameAvailabilityValidator = new \BoilerAppUser\Validator\DisplayNameAvailabilityValidator();
	}

	public function testSetCurrentDisplayName(){
		$this->assertEquals($this->displayNameAvailabilityValidator,$this->displayNameAvailabilityValidator->setCurrentDisplayName('Test'));
		$this->assertEquals('Test', $this->displayNameAvailabilityValidator->getCurrentDisplayName());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testSetCurrentDisplayNameWithWrongDisplayNameType(){
		$this->displayNameAvailabilityValidator->setCurrentDisplayName(null);
	}

	public function testIsValidDisplayNameInvalid(){
		$this->assertFalse($this->displayNameAvailabilityValidator->isValid(''));
		$this->assertEquals(array('displayNameInvalid' => 'Invalid type given. String expected'), $this->displayNameAvailabilityValidator->getMessages());
	}

	public function testIsValidDisplayNameSameAsCurrentlyUsed(){
		$this->assertFalse($this->displayNameAvailabilityValidator->setCurrentDisplayName('Test')->isValid('Test'));
		$this->assertEquals(array('displayNameSameAsCurrentlyUsed' => 'Le nom d\'utilisateur est identique'), $this->displayNameAvailabilityValidator->getMessages());
	}

	public function testIsValidDisplayNameUnavailable(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppUserTest\Fixture\UserLoggedFixture'));

		$this->assertFalse($this->displayNameAvailabilityValidator->setCurrentDisplayName('Test')->isValid('Valid'));
		$this->assertEquals(array('displayNameUnavailable' => 'Le nom d\'utilisateur "Valid" est indisponible'), $this->displayNameAvailabilityValidator->getMessages());
	}
}