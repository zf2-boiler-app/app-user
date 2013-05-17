<?php
namespace BoilerAppUser\Validator;
class DisplayNameAvailabilityValidator extends \Zend\Validator\AbstractValidator{
	const INVALID = 'displayNameInvalid';
    const SAME_AS_CURRENTLY_USED = 'displayNameSameAsCurrentlyUsed';
	const UNAVAILABLE  = 'displayNameUnavailable';

    /**
     * @var array
     */
    protected $messageTemplates = array(
    	self::INVALID => 'Invalid type given. String expected',
    	self::SAME_AS_CURRENTLY_USED => 'The display name "%value%" is the same as currently used',
        self::UNAVAILABLE => 'The display name "%value%" is unavailable'
    );

    /**
     * Default options to set for the validator
     * @var array
     */
    protected $options = array(
    	'currentDisplayName' => null,
    	'checkAvailabilityCallback' => null
    );

    /**
     * @param string $sCurrentDisplayName
     * @throws \InvalidArgumentException
     * @return \BoilerAppAccessControl\Validator\DisplayNameAvailabilityValidator
     */
    public function setCurrentDisplayName($sCurrentDisplayName){
    	if(!is_string($sCurrentDisplayName))throw new \InvalidArgumentException(sprintf(
    		'Current display name expects string, "%s" given',
    		gettype($sCurrentDisplayName)
    	));
		$this->options['currentDisplayName'] = $sCurrentDisplayName;
    	return $this;
    }

    /**
	 * @return string|null
     */
    public function getCurrentDisplayName(){
    	return $this->options['currentDisplayName'];
    }

	/**
	 * @param callable $oCallback
	 * @throws \BadFunctionCallException
	 * @return \BoilerAppUser\Validator\IdentityAvailabilityValidator
	 */
    public function setCheckAvailabilityCallback(callable $oCallback){
    	$this->options['checkAvailabilityCallback'] = $oCallback;
    	return $this;
    }

    /**
     * @return callable|null
     */
    public function getCheckAvailabilityCallback(){
    	return $this->options['checkAvailabilityCallback'];
    }

    /**
     * @param string $sDisplayName
     * @return boolean
     */
    public function checkAvailability($sDisplayName){
    	$oCallback = $this->getCheckAvailabilityCallback();
    	return ($oCallback = $this->getCheckAvailabilityCallback())
    		?!!call_user_func($oCallback,$sDisplayName)
    		:false;
    }

	/**
	 * Check if display name is the same as current (if defined)
	 * @param string $sDisplayName
	 * @return boolean
	 */
    public function sameAsCurrentlyUsed($sDisplayName){
    	return ($sCurrentDisplayName = $this->getCurrentDisplayName())?$sCurrentDisplayName === $sDisplayName:false;
    }

    /**
     * Returns true if $sValue is not the same as current (if defined) and if is available
     * @param string $sValue
     * @return boolean
     */
    public function isValid($sValue){
    	if(empty($sValue)|| !is_string($sValue)){
    		$this->error(self::INVALID);
    		return false;
    	}

    	$this->setValue($sValue);

    	if($this->sameAsCurrentlyUsed($sValue)){
    		$this->error(self::SAME_AS_CURRENTLY_USED,$sValue);
    		return false;
    	}
    	if($this->checkAvailability($sValue))return true;
    	$this->error(self::UNAVAILABLE,$sValue);
    	return false;
    }
}