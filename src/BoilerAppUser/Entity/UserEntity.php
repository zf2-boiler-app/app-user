<?php
namespace BoilerAppUser\Entity;
/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="\BoilerAppUser\Repository\UserRepository")
 * @\Doctrine\ORM\Mapping\Table(name="users")
 */
class UserEntity extends \BoilerAppDb\Entity\AbstractEntity{

	/**
	 * @var int
	 * @\Doctrine\ORM\Mapping\Id
	 * @\Doctrine\ORM\Mapping\Column(type="integer")
	 * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
	 */
	protected $user_id;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="string",unique=true,length=255)
	 */
	protected $user_display_name;

	/**
	 * @var \BoilerAppAccessControl\Entity\AuthAccessEntity
     * @\Doctrine\ORM\Mapping\OneToOne(targetEntity="BoilerAppAccessControl\Entity\AuthAccessEntity", mappedBy="auth_access_user")
	 */
	protected $user_auth_access;

	/**
	 * @return int
	 */
	public function getUserId(){
		return $this->user_id;
	}

	/**
	 * @param string $sDisplayName
	 * @return \BoilerAppUser\Entity\UserEntity
	 */
	public function setUserDisplayName($sDisplayName){
		$this->user_display_name = $sDisplayName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUserDisplayName(){
		return $this->user_display_name;
	}

	/**
	 * @param \BoilerAppAccessControl\Entity\AuthAccessEntity $oUserAuthAccess
	 * @return \BoilerAppUser\Entity\UserEntity
	 */
	public function setUserAuthAccess(\BoilerAppAccessControl\Entity\AuthAccessEntity $oUserAuthAccess){
		$this->user_auth_access = $oUserAuthAccess;
		return $this;
	}

	/**
	 * @return \BoilerAppAccessControl\Entity\AuthAccessEntity
	 */
	public function getUserAuthAccess(){
		return $this->user_auth_access;
	}
}