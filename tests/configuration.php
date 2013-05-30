<?php
return array(
	'paths' => array(
    	'avatarsPath' => __DIR__.'/_files/avatars'
    ),
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'params' => array(
					'dbname' => 'app-user-tests'
				)
			)
		)
	)
);