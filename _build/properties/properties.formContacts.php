<?php

$properties = array();

$tmp = array(
	'tpl' => array(
		'type' => 'textfield',
		'value' => 'emailContacts',
	),
	'fields' => array(
		'type' => 'textfield',
		'value' => 'name,email,message',
	),
    'validate' => array(
        'type' => 'textfield',
        'value' => 'name,email,message',
    ),
    'emailTo' => array(
        'type' => 'textfield',
        'value' => '',
    ),
    'subject' => array(
        'type' => 'textfield',
        'value' => 'Message from site',
    ),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;