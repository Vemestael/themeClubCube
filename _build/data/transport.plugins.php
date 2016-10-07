<?php

$plugins = array();

$tmp = array(
	'lowerCaseUrl' => array(
		'file' => 'lowerCaseUrl',
		'description' => '',
		'events' => array(
			'OnHandleRequest' => array()
		)
	),
//	'clearCache' => array(
//			'file' => 'clearCache',
//			'description' => '',
//			'events' => array(
//					'OnBeforeCacheUpdate' => array()
//			)
//	),
    'changeColorSheme' => array(
        'file' => 'changeColorSheme',
        'description' => '',
        'events' => array(
            'OnWebPageInit' => array(),
            'OnLoadWebDocument' => array()
        )
    )
);

foreach ($tmp as $k => $v) {
	/* @avr modplugin $plugin */
	$plugin = $modx->newObject('modPlugin');
	$plugin->fromArray(array(
		'name' => $k,
		'category' => 0,
		'description' => @$v['description'],
		'plugincode' => getSnippetContent($sources['elements_core'].'/plugins/'.$v['file'].'.php'),
		'static' => BUILD_PLUGIN_STATIC,
		'source' => 1,
		'static_file' => 'assets/'.PKG_NAME_LOWER.'-elements/plugins/'.$v['file'].'.php'
		),'',true,true);

	$events = array();
	if (!empty($v['events'])) {
		foreach ($v['events'] as $k2 => $v2) {
			/* @var modPluginEvent $event */
			$event = $modx->newObject('modPluginEvent');
			$event->fromArray(array_merge(
				array(
					'event' => $k2,
					'priority' => 0,
					'propertyset' => 0,
				), $v2
			),'',true,true);
			$events[] = $event;
		}
		unset($v['events']);
	}

	if (!empty($events)) {
		$plugin->addMany($events);
	}

	$plugins[] = $plugin;
}

unset($tmp, $properties);
return $plugins;