<?php

$settings = array();

$tmp = array(
    //main
//	'ga_tracking_id' => array(
//		'xtype' => 'textfield',
//		'value' => '',
//		'area' => 'themeclubcube_main',
//	),
    'design_url' => array(
        'xtype' => 'textfield',
        'value' => '{assets_url}'.PKG_NAME_LOWER.'-design/',
        'area' => 'themeclubcube_main',
    ),
	'events_resource' => array(
		'xtype' => 'textfield',
		'value' => '7',
		'area' => 'themeclubcube_resources',
	),
	'video_resource' => array(
		'xtype' => 'textfield',
		'value' => '8',
		'area' => 'themeclubcube_resources',
	),
	'blog_resource' => array(
		'xtype' => 'textfield',
		'value' => '9',
		'area' => 'themeclubcube_resources',
	),
	'gallery_resource' => array(
		'xtype' => 'textfield',
		'value' => '10',
		'area' => 'themeclubcube_resources',
	),
	'partners_resource' => array(
		'xtype' => 'textfield',
		'value' => '11',
		'area' => 'themeclubcube_resources',
	),
	'color_scheme' => array(
        'xtype' => 'textfield',
        'value' => 'green-violet',
        'area' => 'themeclubcube_main',
    ),
//    'home_page' => array(
//        'xtype' => 'textfield',
//        'value' => '1',
//        'area' => 'themeclubcube_main',
//    ),
//    'color_scheme' => array(
//        'xtype' => 'textfield',
//        'value' => 'default',
//        'area' => 'themeclubcube_main',
//    ),
//    'demo' => array(
//        'xtype' => 'numberfield',
//        'value' => '0',
//        'area' => 'themeclubcube_main',
//    ),
//
//    //subscribe
//    'unisender_api_key' => array(
//        'xtype' => 'textfield',
//        'value' => '',
//        'area' => 'themeclubcube_subscribe',
//    ),
//    'unisender_list_ids' => array(
//        'xtype' => 'textfield',
//        'value' => '',
//        'area' => 'themeclubcube_subscribe',
//    ),
//
//    // style index
//    'style_index_gallery_list' => array(
//        'xtype' => 'numberfield',
//        'value' => 1,
//        'area' => 'themeclubcube_style_index',
//    ),
//    'style_index_blog_list' => array(
//        'xtype' => 'numberfield',
//        'value' => 1,
//        'area' => 'themeclubcube_style_index',
//    ),
//    'style_index_events_list' => array(
//        'xtype' => 'numberfield',
//        'value' => 2,
//        'area' => 'themeclubcube_style_index',
//    ),
//    'style_events_time_format' => array(
//        'xtype' => 'combo-boolean',
//        'value' => false,
//        'area' => 'themeclubcube_style_index',
//    ),
//    'style_events_promo_slider' => array(
//        'xtype' => 'numberfield',
//        'value' => 1,
//        'area' => 'themeclubcube_style_index',
//    ),
//
//    // resources
//    'partners_resource' => array(
//        'xtype' => 'numberfield',
//        'value' => '',
//        'area' => 'themeclubcube_resources',
//    ),
//    'blog_resource' => array(
//        'xtype' => 'numberfield',
//        'value' => '',
//        'area' => 'themeclubcube_resources',
//    ),
//    'gallery_resource' => array(
//        'xtype' => 'numberfield',
//        'value' => '',
//        'area' => 'themeclubcube_resources',
//    ),
//    'events_resource' => array(
//        'xtype' => 'numberfield',
//        'value' => '',
//        'area' => 'themeclubcube_resources',
//    ),
//    'ajax_form_contacts' => array(
//        'xtype' => 'numberfield',
//        'value' => '',
//        'area' => 'themeclubcube_resources',
//    ),
//    'ajax_form_subscribe' => array(
//        'xtype' => 'numberfield',
//        'value' => '',
//        'area' => 'themeclubcube_resources',
//    ),

);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'themeclubcube.'.$k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	),'',true,true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
