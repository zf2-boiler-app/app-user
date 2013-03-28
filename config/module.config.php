<?php
return array(
	'router' => include 'module.config.routes.php',
	'asset_bundle' => include 'module.config.assets.php',
	'paths' => array(
    	'avatarsPath' => __DIR__.'/../data/avatars'
    ),
	'controllers' => array(
        'invokables' => array(
            'BoilerAppUser\Controller\User' => 'BoilerAppUser\Controller\UserController',
        	'BoilerAppUser\Controller\UserAccount' => 'BoilerAppUser\Controller\UserAccountController'
        )
    ),
	// Doctrine config
	'doctrine' => array(
		'driver' => array(
			'user_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/BoilerAppUser/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
					'BoilerAppUser\Entity' => 'user_driver'
				)
			)
		)
	),
	'translator' => array(
		'translation_file_patterns' => array(
			array(
				'type' => 'phparray',
				'base_dir' => __DIR__ . '/../languages',
				'pattern'  => '%s/Common.php'
			),
			array(
				'type' => 'phparray',
				'base_dir' => __DIR__ . '/../languages',
				'pattern'  => '%s/Validate.php',
        		'text_domain' => 'validator'
			)
		)
	),
	'messenger' => array(
		'view_manager' => array(
			'template_map' => array(
				'email/user/confirm-email' => __DIR__ . '/../view/user/email/confirm-email.phtml',
				'email/user/confirm-reset-password' => __DIR__ . '/../view/user/email/confirm-reset-password.phtml',
				'email/user/password-reset' => __DIR__ . '/../view/user/email/password-reset.phtml',
				'email/user/password-changed' => __DIR__ . '/../view/user/email/password-changed.phtml'
			)
		)
	),
    'view_manager' => array(
    	'template_path_stack' => array('User' => __DIR__ . '/../view')
    ),
	'service_manager' => array(
		'factories' => array(
			'UserService' => 'BoilerAppUser\Factory\UserServiceFactory',
			'UserAccountService' => 'BoilerAppUser\Factory\UserAccountServiceFactory',
			'UserModel' => 'BoilerAppUser\Factory\UserModelFactory',
			'UserProviderModel' => 'BoilerAppUser\Factory\UserProviderModelFactory',
			'ChangeAvatarForm' => 'BoilerAppUser\Factory\ChangeAvatarFormFactory',
			'ChangeEmailForm' => 'BoilerAppUser\Factory\ChangeEmailFormFactory',
			'ChangePasswordForm' => 'BoilerAppUser\Factory\ChangePasswordFormFactory',
		)
	),
	'controller_plugins' => array(
       	'invokables' => array(
        	'userMustBeLoggedIn' => 'BoilerAppUser\Mvc\Controller\Plugin\UserMustBeLoggedInPlugin',
       	)
    ),
	'view_helpers' => array(
		'factories' => array(
			'userAvatar' => 'BoilerAppUser\Factory\UserAvatarHelperFactory'
		)
	)
);