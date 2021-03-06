<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'ACINTRANS',
	'language'=>'es',
	'sourceLanguage'=>'en',
	'charset'=>'utf-8',

	// preloading 'log' component
	'preload'=>array('log', 'Booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.Booster.helpers.TbHtml',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'ElGatoRobotConBotasMagicas$',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=> array('ext.Booster.gii'),
		),
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'Booster' => array(
 			'class' => 'ext.Booster.components.Booster',
 			'responsiveCss' => true,
 		),
 		'CalculoID'=>array(
        	'class'=>'CalculoID',
    	),
    	'FuncionesImportantes'=>array(
    		'class'=>'FuncionesImportantes',
    	),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'urlSuffix'=>'.jsp',
			'rules'=>array(
				// '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				// '<controller:\w+>/<action:\d+>'=>'<controller>/<action>',
				'<_c:(post|comment)>/<id:\d+>/<_a:(create|update|delete)>' => '<_c>/<_a>',
    			'<_c:(post|comment)>/<id:\w+>' => '<_c>/view',
    			'<_c:(post|comment)>s' => '<_c>/list',
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			/*
			'routes'=>array(
				array(
					//'class'=>'CFileLogRoute',
					'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
					'levels'=>'error, warning',
					'ipFilters'=>array('127.0.0.1','192.168.1.215'),
				),
				// descomentar la siguiente para mostrar los mensajes de registro en las páginas web
				array(
					'class'=>'CWebLogRoute',
				),
			),
			*/

		),

		'ePdf' => array(
	        'class' 		=> 'ext.yii-pdf.EYiiPdf',
	        'params'        => array(
	            'mpdf'    	=> array(
	                'librarySourcePath' => 'application.vendors.mpdf.*',
	                'constants'         => array(
	                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
	                ),
	                'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
	                	'class'				=>'mpdf', // the literal class filename to be loaded from the vendors folder
	                    'mode'              => 'c', //  This parameter specifies the mode of the new document.
	                    'format'            => 'LETTER', // format A4, A5, ...
	                    'default_font_size' => 0, // Sets the default document font size in points (pt)
	                    //'default_font'      => '', // Sets the default font-family for the new document.
	                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
	                    'mgr'               => 15, // margin_right
	                    'mgt'               => 40, // margin_top
	                    'mgb'               => 16, // margin_bottom
	                    'mgh'               => 9, // margin_header
	                    'mgf'               => 9, // margin_footer
	                    'orientation'       => 'P', // landscape or portrait orientation
	                    /*
	                    */
	                )
	            ),
	        ),
		),

		//
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@acintrans.com.ve',
	),
);
