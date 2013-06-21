<?php
namespace BoilerAppUser\Controller;
class UserAccountController extends \BoilerAppDisplay\Mvc\Controller\AbstractActionController{

	/**
	 * Show account view
	 * @return \Zend\View\Model\ViewModel
	 */
	public function indexAction(){
		//Define title
		$this->layout()->title = $this->getServiceLocator()->get('Translator')->translate('account');
		return $this->view;
	}

	/**
	 * Show change user avatar form or process user avatar change attempt
	 * @throws \LogicException
	 * @return \Zend\View\Model\ViewModel
	 */
	public function changeAvatarAction(){
		if($this->getRequest()->isPost())$this->view->setTerminal(true);
		elseif(!$this->getRequest()->isXmlHttpRequest())throw new \LogicException('Only ajax requests are allowed for action "changeAvatar"');

		//Assign form
		$this->view->form = $this->getServiceLocator()->get('ChangeUserAvatarForm');
		if(
			$this->getRequest()->isPost()
			&& $this->view->form->setData($this->params()->fromFiles())->isValid()
			&& ($aData = $this->view->form->getData())
			&& $this->getServiceLocator()->get('UserAccountService')->changeAuthenticatedUserAvatar($aData['new_user_avatar']['tmp_name'])
		)$this->view->avatarChanged = true;
		return $this->view;
	}

	/**
	 * Show change user display name form or process user display name change attempt
	 * @throws \LogicException
	 * @return \Zend\View\Model\ViewModel
	 */
	public function changeDisplayNameAction(){
		if(!$this->getRequest()->isXmlHttpRequest())throw new \LogicException('Only ajax requests are allowed for action "changeDisplayName"');

		//Assign form
		$this->view->form = $this->getServiceLocator()->get('ChangeUserDisplayNameForm');
		if(
			$this->getRequest()->isPost()
			&& $this->view->form->setData($this->params()->fromPost())->isValid()
			&& ($aData = $this->view->form->getData())
			&& $this->getServiceLocator()->get('UserAccountService')->changeAuthenticatedUserDisplayName($aData['new_user_display_name'])
		)$this->view->displayNameChanged = true;
		return $this->view;
	}

	/**
	 * Process ajax request to check display name availability
	 * @throws \LogicException
	 * @return \Zend\View\Model\JsonModel
	 */
	public function checkDisplayNameAvailabilityAction(){
		if(!$this->getRequest()->isXmlHttpRequest())throw new \LogicException('Only ajax requests are allowed for action "checkDisplayNameAvailability"');
		if(!($sDisplayName = $this->params()->fromPost('display_name')))throw new \LogicException('"display_name" param is missing');
		return $this->view->setVariable(
			'available',
			$this->getServiceLocator()->get('UserService')->isUserDisplayNameAvailable($sDisplayName)
		);
	}
}