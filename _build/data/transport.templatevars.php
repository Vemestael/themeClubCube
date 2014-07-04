<?php

$tvs = array();

$tmp = array(
    'img' => array(
        'name' => 'img',
        'caption' => 'Preview',
        'description' => '',
        'type' => 'image',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    )
);

foreach ($tmp as $k => $v) {
    /* @avr modSnippet $snippet */
    $tv = $modx->newObject('modTemplateVar');
    $tv->fromArray($v,'',true,true);

    $tvs[] = $tv;
}

unset($tmp);
return $tvs;