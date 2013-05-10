<?php
return array(
	'router' => include 'module.config.routes.php',
	'asset_bundle' => include 'module.config.assets.php',
	'paths' => array(
    	'avatarsPath' => __DIR__.'/../data/avatars'
    ),
	'controllers' => array(
        'invokables' => array(
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
    'view_manager' => array(
    	'template_path_stack' => array('User' => __DIR__ . '/../view')
    ),
	'service_manager' => array(
		'factories' => array(
			'UserService' => 'BoilerAppUser\Factory\UserServiceFactory',
			'UserAccountService' => 'BoilerAppUser\Factory\UserAccountServiceFactory',
			'UserModel' => 'BoilerAppUser\Factory\UserModelFactory',
			'UserProviderModel' => 'BoilerAppUser\Factory\UserProviderModelFactory',
			'ChangeUserAvatarForm' => 'BoilerAppUser\Factory\ChangeUserAvatarFormFactory',
			'ChangeUserDisplayNameForm' => 'BoilerAppUser\Factory\ChangeUserDisplayNameFormFactory',
		)
	),
	'view_helpers' => array(
		'factories' => array(
			'userAvatar' => 'BoilerAppUser\Factory\UserAvatarHelperFactory'
		)
	)
);