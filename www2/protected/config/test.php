<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'log' => array(
    'class' => 'CLogRouter',
    'routes' => array(
        array(
            'class' => 'CFileLogRoute',
            'levels' => 'trace, info, error, warning, vardump',
        ),
        // uncomment the following to show log messages on web pages
        array(
            'class' => 'CWebLogRoute',
            'enabled' => YII_DEBUG,
            'levels' => 'error, warning, trace, notice',
            'categories' => 'application',
            'showInFireBug' => false,
        ),
    ),
),
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
            
			/* uncomment the following to provide test database connection
			'db'=>array(
				'connectionString'=>'DSN for test database',
			),
			*/
		),
	)
);
