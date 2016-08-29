<?php

$tvs = array();

$tmp = array(
    'viewType' => array(
        'type' => 'option',
        'name' => 'viewType',
        'caption' => 'Тип отображения',
        'elements' => 'Вид 1==a||Вид 2==b||Вид 3==c',
        'display' => 'default',
        'default_text' => 'a',
    ),
    'img' => array(
        'name' => 'img',
        'caption' => 'Preview',
        'description' => 'Recommended size: Events - 768x360, Blog - 768x172, Gallery - 768x195',
        'type' => 'image',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'timeStart' => array(
        'name' => 'timeStart',
        'caption' => 'Time start',
        'description' => '',
        'type' => 'date',
        'display' => 'default',
        'inopt_allowBlank' => false
    ),
    'imgSquare' => array(
        'name' => 'imgSquare',
        'caption' => 'Preview Square',
        'description' => '',
        'type' => 'image',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'videoLink' => array(
        'name' => 'videoLink',
        'caption' => 'Video link',
        'description' => '',
        'type' => 'url',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'topEvent' => array(
        'type' => 'option',
        'name' => 'topEvent',
        'caption' => 'Type event',
        'elements' => 'Top event==1||Past event==2',
        'display' => 'default',
        'default_text' => 'a',
    ),
    'partnerLink' => array(
        'name' => 'partnerLink',
        'caption' => 'Partner link',
        'description' => '',
        'type' => 'url',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'contactNumber' => array(
        'name' => 'contactNumber',
        'caption' => 'Contact number',
        'description' => '',
        'type' => 'text',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'contactEmail' => array(
        'name' => 'contactEmail',
        'caption' => 'Contact email',
        'description' => '',
        'type' => 'text',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'ticketPrice' => array(
        'name' => 'ticketPrice',
        'caption' => 'Ticket price',
        'description' => '',
        'type' => 'text',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'annotationText' => array(
        'name' => 'annotationText',
        'caption' => 'Annotation text',
        'description' => '',
        'type' => 'text',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'eventHeaderViewType' => array(
        'type' => 'option',
        'name' => 'eventHeaderViewType',
        'caption' => 'Тип отображения заголовка при открытии ивента',
        'elements' => 'Дата + стоимость==1||Обратный отсчет до события==2',
        'display' => 'default',
        'default_text' => '1',
    ),
    'audioLink' => array(
        'name' => 'audioLink',
        'caption' => 'Audio link',
        'description' => '',
        'type' => 'url',
        'display' => 'text',
        'locked' => 0,
        'rank' => 0,
    ),
    'audioViewType' => array(
        'type' => 'option',
        'name' => 'audioViewType',
        'caption' => 'Тип отображения плеера',
        'elements' => 'С плейлистом==1||Только один трек==2',
        'display' => 'default',
        'default_text' => '1',
    ),
    'blogViewType' => array(
        'type' => 'option',
        'name' => 'blogViewType',
        'caption' => 'Тип отображения записей блога',
        'elements' => 'Вид 1==b-box||Вид 2==b-box b-box-sm||Вид 3==b-box b-box--clr-a||Вид 4==b-box b-box--clr-b||Вид 5==b-box b-box-sm b-box--clr-b',
        'display' => 'default',
        'default_text' => 'b-box',
    ),
//    'img' => array(
//        'name' => 'img',
//        'caption' => 'Preview',
//        'description' => 'Recommended size: Events - 768x360, Blog - 768x172, Gallery - 768x195',
//        'type' => 'image',
//        'display' => 'text',
//        'locked' => 0,
//        'rank' => 0,
//    ),
//    'galleryImg' => array(
//        'name' => 'galleryImg',
//        'caption' => 'Images',
//        'description' => '',
//        'type' => 'image',
//        'display' => 'text',
//        'locked' => 0,
//        'rank' => 0,
//    ),
//    'galleryImgTitle' => array(
//        'name' => 'galleryImgTitle',
//        'caption' => 'Title',
//        'description' => '',
//        'type' => 'text',
//        'display' => 'default',
//    ),
//    'timeStart' => array(
//        'name' => 'timeStart',
//        'caption' => 'Time start',
//        'description' => '',
//        'type' => 'date',
//        'display' => 'default',
//        'inopt_allowBlank' => false
//    ),
//    'price' => array(
//        'name' => 'price',
//        'caption' => 'Price',
//        'description' => '',
//        'type' => 'text',
//        'display' => 'default',
//        'inopt_allowBlank' => false
//    ),
//    'lineUpName' => array(
//        'name' => 'lineUpName',
//        'caption' => 'Line Up - Name',
//        'description' => '',
//        'type' => 'text',
//        'display' => 'default',
//    ),
//    'lineUpLocation' => array(
//        'name' => 'lineUpLocation',
//        'caption' => 'Line Up - Location',
//        'description' => '',
//        'type' => 'text',
//        'display' => 'default',
//    ),
//    'topEvent' => array(
//        'name' => 'topEvent',
//        'caption' => 'Top event',
//        'description' => 'if checked, event show in top event on main page',
//        'type' => 'checkbox',
//        'elements' => 'On==1',
//        'default_text' => '0',
//        'display' => 'default',
//    ),
//    'promoEvent' => array(
//        'name' => 'promoEvent',
//        'caption' => 'Promo event',
//        'description' => 'if checked, event show in big slider on main page',
//        'type' => 'checkbox',
//        'elements' => 'On==1',
//        'default_text' => '0',
//        'display' => 'default',
//    ),
//    'promoImg' => array(
//        'name' => 'promoImg',
//        'caption' => 'Promo preview',
//        'description' => 'Recommended size: 2048x1365',
//        'type' => 'image',
//        'display' => 'text',
//        'locked' => 0,
//        'rank' => 0,
//    ),
);

foreach ($tmp as $k => $v) {
    /* @avr modSnippet $snippet */
    $tv = $modx->newObject('modTemplateVar');
    $tv->fromArray($v,'',true,true);

    $tvs[] = $tv;
}

unset($tmp);
return $tvs;