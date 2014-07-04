<?php

$settings = array();

$tmp = array(
	'ga_tracking_id' => array(
		'xtype' => 'textfield',
		'value' => '',
		'area' => 'themeclubcube_main',
	),
    'ga_tracking_name' => array(
        'xtype' => 'textfield',
        'value' => 'auto',
        'area' => 'themeclubcube_main',
    ),
    'design_url' => array(
        'xtype' => 'textfield',
        'value' => '{assets_url}'.PKG_NAME_LOWER.'-design/',
        'area' => 'themeclubcube_main',
    ),
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'themeclubcube_'.$k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	),'',true,true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
