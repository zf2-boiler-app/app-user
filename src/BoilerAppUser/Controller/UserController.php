<?php
namespace BoilerAppUser\Controller;
class UserController extends \Templating\Mvc\Controller\AbstractActionController{
	public function indexAction(){
		return $this->view;
	}
}