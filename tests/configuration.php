<?php
return array(
	'asset_bundle' => array(
		'cachePath' => __DIR__.'/_files/cache',
		'cacheUrl' => '@zfBaseUrl/cache/',
		'assetsPath' => null
	),
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host'     => 'localhost',
					'user'     => 'root',
					'password' => '',
					'dbname'   => 'app-user-tests'
				)
			)
		)
	),
	'service_manager' => array(
		'factories' => array(
			'Logger' => function(){
				$oLogger = new \Zend\Log\Logger();
				return $oLogger->addWriter(new \Zend\Log\Writer\Stream(STDERR));
			}
		)
	),
);