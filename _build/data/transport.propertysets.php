<?php

$propertysets = array();

$tmp = array(
    'indexSlider' => array(
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
            'value' => 'timeStart',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        ),
    ),
    'indexEvents' => array(
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
    ),
    'blogList' => array(
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
    'eventsListAll' => array(
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
            'value' => 'timeStart',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        )
    ),
    'eventsListWeek' => array(
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
            'value' => 'timeStart',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        )
    ),
    'galleryList' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '6',
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
    'asideBlog' => array(
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
    'asideEvents' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '2',
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