<?php
return array(
	'routes' => array(
		'User' => array(
			'type' => 'Zend\Mvc\Router\Http\Literal',
			'options' => array(
				'route' => '/user'
			),
			'may_terminate' => true,
			'child_routes' => array(
				'Account' => array(
					'type' => 'Zend\Mvc\Router\Http\Literal',
					'options' => array(
						'route' => '/account',
						'defaults' => array(
							'controller' => 'BoilerAppUser\Controller\UserAccount',
							'action' => 'index'
						)
					),
					'may_terminate' => true,
					'child_routes' => array(
						'ChangeAvatar' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
								'route' => '/change-avatar',
								'defaults' => array(
									'controller' => 'BoilerAppUser\Controller\UserAccount',
									'action' => 'changeAvatar'
								)
							)
						),
						'ChangeDisplayName' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
								'route' => '/change-display-name',
								'defaults' => array(
									'controller' => 'BoilerAppUser\Controller\UserAccount',
									'action' => 'changeDisplayName'
								)
							)
						),
						'CheckDisplayNameAvailability' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
								'route' => '/check-display-name-availability',
								'defaults' => array(
									'controller' => 'BoilerAppUser\Controller\UserAccount',
									'action' => 'checkDisplayNameAvailability'
								)
							)
						)
					)
				)
			)
		)
	)
);