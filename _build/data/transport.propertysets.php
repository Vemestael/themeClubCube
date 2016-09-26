<?php

$propertysets = array();

$tmp = array(
     'mainMenu' => array(
         array(
             'name' => 'level',
             'type' => 'numberfield',
             'value' => '2',
         ),
         array(
             'name' => 'useWeblinkUrl',
             'type' => 'combo-boolean',
             'value' => false,
         )
     ),
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
    'topEvents' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '4',
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
    'topIndexEvents' => array(
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
            'value' => 'timeStart',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        ),
    ),
    'topIndexFEvents' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '9',
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
    'indexTopEventsGallery' => array(
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
            'value' => 'timeStart',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        ),
    ),
    'indexVideo' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '4',
        )
        ,array(
            'name' => 'depth',
            'type' => 'numberfield',
            'value' => '1',
        )
        ,array(
                'name' => 'sotrby',
                'type' => 'textfield',
                'value' => 'publishedon',
        )
        ,array(
                'name' => 'sortdir',
                'type' => 'textfield',
                'value' => 'ASC',
        ),
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
            'value' => 'publishedon',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        ),
    ),
    'indexBlogGallery' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '8',
        )
        ,array(
            'name' => 'depth',
            'type' => 'numberfield',
            'value' => '1',
        )
        ,array(
            'name' => 'sotrby',
            'type' => 'textfield',
            'value' => 'publishedon',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        ),
    ),
    'pastEvents' => array(
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
    'pastEventsIndexGallery' => array(
        array(
            'name' => 'limit',
            'type' => 'numberfield',
            'value' => '4',
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
            'name' => 'depth',
            'type' => 'numberfield',
            'value' => '1',
        )
        ,array(
            'name' => 'sotrby',
            'type' => 'textfield',
            'value' => 'publishedon',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        ),
    ),
    'blogList' => array(
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
    'blogEventsDown' => array(
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
    'blogEventsSidebar' => array(
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
        ),
    ),
    'eventsList' => array(
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
            'value' => 'timeStart',
        )
        ,array(
            'name' => 'sortdir',
            'type' => 'textfield',
            'value' => 'ASC',
        ),
    ),
    'eventsOpenSidebar' => array(
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
//    'mainMenu' => array(
//        array(
//            'name' => 'level',
//            'type' => 'numberfield',
//            'value' => '2',
//        ),
//        array(
//            'name' => 'useWeblinkUrl',
//            'type' => 'combo-boolean',
//            'value' => false,
//        )
//    ),
//    'indexSlider' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '0',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'timeStart',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'ASC',
//        ),
//    ),
//    'indexEvents' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '0',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'timeStart',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'ASC',
//        ),
//    ),
//    'indexGallery' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '12',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'publeshedon',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'DESC',
//        )
//    ),
//    'indexBlog' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '3',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'publeshedon',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'DESC',
//        )
//    ),
//    'indexPartners' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '0',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'menuindex',
//        )
//    ),
//    'blogList' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '12',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'publeshedon',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'DESC',
//        )
//    ),
//    'eventsListAll' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '12',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'timeStart',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'ASC',
//        )
//    ),
//    'eventsListWeek' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '0',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'timeStart',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'ASC',
//        )
//    ),
//    'galleryList' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '12',
//        )
//            ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'publeshedon',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'DESC',
//        )
//    ),
//    'asideBlog' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '3',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'publeshedon',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'DESC',
//        )
//    ),
//    'asideEvents' => array(
//        array(
//            'name' => 'limit',
//            'type' => 'numberfield',
//            'value' => '2',
//        )
//        ,array(
//            'name' => 'depth',
//            'type' => 'numberfield',
//            'value' => '1',
//        )
//        ,array(
//            'name' => 'sotrby',
//            'type' => 'textfield',
//            'value' => 'timeStart',
//        )
//        ,array(
//            'name' => 'sortdir',
//            'type' => 'textfield',
//            'value' => 'ASC',
//        ),
//    ),
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
