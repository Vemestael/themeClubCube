<?php

$properties = array();

$tmp = array(
    'tpl' => array(
        'type' => 'textfield',
        'value' => 'moltCommon',
    ),
    'cssFilename' => array(
        'type' => 'textfield',
        'value' => 'styles',
    ),
    'cssSources' => array(
        'type' => 'textfield',
        'value' => '',
    ),
    'styleHeadSources' => array(
        'type' => 'textfield',
        'value' => '',
    ),
    'cssPack' => array(
        'xtype' => 'combo-boolean',
        'value' => true
    ),
    'styleHeadPack' => array(
        'xtype' => 'combo-boolean',
        'value' => true
    ),
    'cssDeferred' => array(
        'xtype' => 'combo-boolean',
        'value' => true
    ),
    'cssPlaceholder' => array(
        'xtype' => 'textfield',
        'value' => 'Molt.css',
    ),
    'styleHeadPlaceholder' => array(
        'xtype' => 'textfield',
        'value' => 'MoltHead.css',
    ),
    'styleHeadRegister' => array(
        'xtype' => 'list',
        'value' => 'head',
        'options' => array(
            array('name' => 'In head', 'value' => 'head'),
            array('name' => 'Placeholder', 'value' => 'placeholder'),
        )
    ),
    'cssRegister' => array(
        'xtype' => 'list',
        'value' => 'head',
        'options' => array(
            array('name' => 'Placeholder', 'value' => 'placeholder'),
            array('name' => 'In head', 'value' => 'head'),
        )
    ),
    'jsFilename' => array(
        'type' => 'textfield',
        'value' => 'scripts',
    ),
    'jsSources' => array(
        'type' => 'textfield',
        'value' => '',
    ),
    'jsPack' => array(
        'xtype' => 'combo-boolean',
        'value' => true
    ),
    'jsDeferred' => array(
        'xtype' => 'combo-boolean',
        'value' => true
    ),
    'jsPlaceholder' => array(
        'xtype' => 'textfield',
        'value' => 'Molt.js',
    ),
    'jsRegister' => array(
        'xtype' => 'list',
        'value' => 'default',
        'options' => array(
            array('name' => 'Placeholder', 'value' => 'placeholder'),
            array('name' => 'Head script', 'value' => 'head'),
            array('name' => 'Default', 'value' => 'default'),
        )
    ),
    'jquery' => array(
        'xtype' => 'textfield',
        'value' => ''
    ),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_molt_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;