<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'TRACER Data Dictionary',

	// Default Controller to be invoked when the webapp root is accessed
	'defaultController'=>'site',

	// preloading 'log' component
	'preload'=>array('log', 'bootstrap','CodeMirror'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',	
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
				'bootstrap.gii'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			// further clean our URLs, i.e., hiding the entry script index.php in the URL
			'showScriptName' => false,
			// We may also add some sux to our URLs. For example, we can have /post/100.html
			// instead of /post/100. This makes it look more like a URL to a static Web page.
			'urlSuffix' => '.htm',
		),	
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=segtdd',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*array(
					'class'=>'CWebLogRoute',
				),*/
			),
		),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap',
		),
		'CodeMirror'=>array(
			'class'=>'ext.CodeMirror.CodeMirror',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'sethbusque@gmail.com',
	),
	/*'defaultController' => 'login',*/
);
