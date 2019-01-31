<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'algo' => [
			'class' => 'common\components\AlgoFunction',
			],
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'thousandSeparator' => '.',
			'decimalSeparator' => ',',
			'dateFormat' => 'php:d M Y',
			'datetimeFormat' => 'php:d-M-Y H:i:s',
			'timeFormat' => 'php:H:i',
			'timeZone' => 'Asia/Jakarta',
			],
    ],
	'modules' => [
		'gridview' =>  [
			'class' => '\kartik\grid\Module',
			],
		'datecontrol' =>  [
			'class' => '\kartik\datecontrol\Module',
			],
	],
];
