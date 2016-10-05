<?php

$snippets = array();

$tmp = array(
    'getDate' => array(
        'file' => 'getDate',
        'description' => '',
    ),
	'getSocialShare' => array(
		'file' => 'getSocialShare',
		'description' => '',
	),
	'getTemplateValues' => array(
		'file' => 'getTemplateValues',
		'description' => '',
	),
    'getMegaMenu' => array(
        'file' => 'getMegaMenu',
        'description' => '',
    ),
    'formSubscribe' => array(
        'file' => 'formSubscribe',
        'description' => '',
    ),
//	'formContacts' => array(
//		'file' => 'formContacts',
//		'description' => '',
//	),
//    'formSubscribe' => array(
//        'file' => 'formSubscribe',
//        'description' => '',
//    ),
//    'time' => array(
//        'file' => 'time',
//        'description' => '',
//    ),
//    'getDate' => array(
//        'file' => 'getDate',
//        'description' => '',
//    ),
//    'getWeeksEvents' => array(
//        'file' => 'getWeeksEvents',
//        'description' => '',
//    ),
//    'getParamsWeeksEvents' => array(
//        'file' => 'getParamsWeeksEvents',
//        'description' => '',
//    ),
//    'parseMIGXTV' => array(
//        'file' => 'parseMIGXTV',
//        'description' => '',
//    ),
//    'getIdResourceForAlias' => array(
//        'file' => 'getIdResourceForAlias',
//        'description' => '',
//    ),
);

foreach ($tmp as $k => $v) {
	/* @avr modSnippet $snippet */
	$snippet = $modx->newObject('modSnippet');
	$snippet->fromArray(array(
		'id' => 0,
		'name' => $k,
		'description' => @$v['description'],
		'snippet' => getSnippetContent($sources['elements_core'].'/snippets/'.$v['file'].'.php'),
		'static' => BUILD_SNIPPET_STATIC,
		'source' => 1,
		'static_file' => 'assets/'.PKG_NAME_LOWER.'-elements/snippets/'.$v['file'].'.php',
	),'',true,true);

	$properties = include $sources['build'].'properties/properties.'.$v['file'].'.php';
	$snippet->setProperties($properties);

	$snippets[] = $snippet;
}

unset($tmp, $properties);
return $snippets;