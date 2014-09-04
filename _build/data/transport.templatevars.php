<?php

$tvs = array();

$tmp = array(
    'img' => array(
        'name' => 'img',
        'caption' => 'Preview',
        'description' => 'Recommended size: Events - 768x360, Blog - 768x172, Gallery - 768x195',
        'type' => 'image',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'galleryImg' => array(
        'name' => 'galleryImg',
        'caption' => 'Images',
        'description' => '',
        'type' => 'image',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'galleryImgTitle' => array(
        'name' => 'galleryImgTitle',
        'caption' => 'Title',
        'description' => '',
        'type' => 'text',
        'display' => 'default',
    ),
    'timeStart' => array(
        'name' => 'timeStart',
        'caption' => 'Time start',
        'description' => '',
        'type' => 'date',
        'display' => 'default',
        'inopt_allowBlank' => false
    ),
    'price' => array(
        'name' => 'price',
        'caption' => 'Price',
        'description' => '',
        'type' => 'text',
        'display' => 'default',
        'inopt_allowBlank' => false
    ),
    'lineUpName' => array(
        'name' => 'lineUpName',
        'caption' => 'Line Up - Name',
        'description' => '',
        'type' => 'text',
        'display' => 'default',
    ),
    'lineUpLocation' => array(
        'name' => 'lineUpLocation',
        'caption' => 'Line Up - Location',
        'description' => '',
        'type' => 'text',
        'display' => 'default',
    ),
    'topEvent' => array(
        'name' => 'topEvent',
        'caption' => 'Top event',
        'description' => 'if checked, event show in top event on main page',
        'type' => 'checkbox',
        'els' => 'On==1',
        'default_text' => '0',
        'display' => 'default',
    ),
    'promoEvent' => array(
        'name' => 'promoEvent',
        'caption' => 'Promo event',
        'description' => 'if checked, event show in big slider on main page',
        'type' => 'checkbox',
        'els' => 'On==1',
        'default_text' => '0',
        'display' => 'default',
    ),
    'promoImg' => array(
        'name' => 'promoImg',
        'caption' => 'Promo preview',
        'description' => 'Recommended size: 1920x1024',
        'type' => 'image',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
);

foreach ($tmp as $k => $v) {
    /* @avr modSnippet $snippet */
    $tv = $modx->newObject('modTemplateVar');
    $tv->fromArray($v,'',true,true);

    $tvs[] = $tv;
}

unset($tmp);
return $tvs;