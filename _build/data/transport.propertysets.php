<?php

$propertysets = array();

$tmp = array(
    'indexEvents' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '12',
        )
        ,array(
            'name' => 'depth',
            'type' => 'numberfield',
            'value' => '1',
        )
        ,array(
            'name' => 'sotrby',
            'type' => 'textfield',
            'value' => 'timeStart',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        ),
    ),
    'indexGallery' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '12',
        )
    ,array(
            'name' => 'depth',
            'type' => 'numberfield',
            'value' => '1',
        )
    ,array(
            'name' => 'sotrby',
            'type' => 'textfield',
            'value' => 'publeshedon',
        )
    ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'DESC',
        )
    ),
    'indexBlog' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '3',
        )
        ,array(
            'name' => 'depth',
            'type' => 'numberfield',
            'value' => '1',
        )
        ,array(
            'name' => 'sotrby',
            'type' => 'textfield',
            'value' => 'publeshedon',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'DESC',
        )
    ),
    'indexPartners' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '0',
        )
        ,array(
            'name' => 'depth',
            'type' => 'numberfield',
            'value' => '1',
        )
        ,array(
            'name' => 'sotrby',
            'type' => 'textfield',
            'value' => 'menuindex',
        )
    )
    ,'listResources' => array(
        array(
            'name' => 'includeTVs',
            'type' => 'textfield',
            'value' => 'img',
        )
        ,array(
                'name' => 'processTVs',
                'type' => 'textfield',
                'value' => 'img',
            )
        ,array(
                'name' => 'tvPrefix',
                'type' => 'textfield',
                'value' => '',
            )
        ,array(
                'name' => 'parents',
                'type' => 'textfield',
                'value' => '[[*id]]',
            )
        ,array(
                'name' => 'limit',
                'type' => 'numberfield',
                'value' => '10',
            )
        ,array(
            'name' => 'depth',
            'type' => 'numberfield',
            'value' => '1',
        )
    ),
);

foreach ($tmp as $k => $v) {
    $propertyset = $modx->newObject('modPropertySet');
    $propertyset->fromArray(array(
        'name' => $k
    ),'',true,true);
    $propertyset->setProperties($v);

    $propertysets[] = $propertyset;
}

unset($tmp);
return $propertysets;