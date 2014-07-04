<?php
$templates = array();

$tmp = array(
    'index' => array(
        'file' => 'index',
        'description' => 'Index template',
    ),
    'list' => array(
        'file' => 'list',
        'description' => 'List of resource template',
    ),
    'listItem' => array(
        'file' => 'listItem',
        'description' => 'ListItem of resource template',
    ),
    'text' => array(
        'file' => 'text',
        'description' => 'Text template',
    ),
    'contacts' => array(
        'file' => 'contacts',
        'description' => 'Contact page template',
    ),
);

// Save chunks for setup options

foreach ($tmp as $k => $v) {
    $template = $modx->newObject('modTemplate');
    $template->fromArray(array(
        'id' => 0,
        'templatename' => $k,
        'description' => @$v['description'],
        'content' => file_get_contents($sources['elements_core'].'/templates/'.$v['file'].'.tpl'),
        'static' => BUILD_TEMPLATE_STATIC,
        'source' => 1,
        'static_file' => 'assets/'.PKG_NAME_LOWER.'-elements/templates/'.$v['file'].'.tpl',
    ),'',true,true);

    $templates[] = $template;
}

unset($tmp);
return $templates;