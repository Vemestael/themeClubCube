<?php
if ($object->xpdo) {
    /* @var modX $modx */
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:

            /* list of tvs and templates for each */
            $categoryId = $modx->getObject('modCategory', array('category'=>'themeClubCube'))->get('id');
            $tvs = array(
                'migxEventArtist' => array(
                    'category' => $categoryId,
                    'name' => 'migxEventArtist',
                    'caption' => 'Artist list',
                    'description' => '',
                    'type' => 'migx',
                    'display' => 'default',
                    'input_properties' => array(
                        'formtabs' =>   '
                                        [
                                            {
                                                "caption":"Artists",
                                                "fields": 
                                                [
                                                {
                                                    "field":"name",
                                                    "caption":"Name"
                                                },
                                                {
                                                    "field":"city",
                                                    "caption":"City"
                                                }
                                                ]
                                            }
                                        ]
                                        ',
                        'columns' =>    '
                                        [
                                            {
                                                "header": "Name", 
                                                "width": "60", 
                                                "sortable": "false", 
                                                "dataIndex": "name"
                                            },
                                            {
                                                "header": "City", 
                                                "width": "50", 
                                                "sortable": "false", 
                                                "dataIndex": "city"
                                            }
                                        ]
                                        '
                    )
                ),
                'imgList' => array(
                    'category' => $categoryId,
                    'name' => 'imgList',
                    'caption' => 'Images for gallery',
                    'description' => '',
                    'type' => 'migx',
                    'display' => 'default',
                    'input_properties' => array(
                        'formtabs' =>   '
                                        [
                                            {
                                                "caption":"Image", 
                                                "fields": 
                                                [
                                                {
                                                    "field":"image",
                                                    "caption":"Image",
                                                    "inputTVtype":"image"
                                                },
                                                {
                                                    "field":"imageMin",
                                                    "caption":"Preview",
                                                    "inputTVtype":"image"
                                                }
                                                ]
                                            }
                                        ]
                                        ',
                        'columns' =>    '
                                        [
                                            {
                                                "header": "Image", 
                                                "sortable": "true", 
                                                "dataIndex": "image",
                                                "renderer": "this.renderImage"
                                            },
                                            {
                                                "header": "Preview", 
                                                "sortable": "true", 
                                                "dataIndex": "imageMin",
                                                "renderer": "this.renderImage"
                                            }
                                        ]
                                        '
                    )
                ),
                'annotationBlog' => array(
                    'category' => $categoryId,
                    'name' => 'annotationBlog',
                    'caption' => 'Annotation for article',
                    'description' => '',
                    'type' => 'migx',
                    'display' => 'default',
                    'input_properties' => array(
                        'formtabs' =>   '
                                        [
                                            {
                                                "caption":"Annotation", 
                                                "fields": 
                                                [
                                                {
                                                    "field":"annotationHead",
                                                    "caption":"Head"
                                                },
                                                {
                                                    "field":"annotationTextAndLink",
                                                    "caption":"Text"
                                                }
                                                ]
                                            }
                                        ]
                                        ',
                        'columns' =>    '
                                        [
                                            {
                                                "header": "Head", 
                                                "dataIndex": "annotationHead"
                                            },
                                            {
                                                "header": "Text", 
                                                "dataIndex": "annotationTextAndLink"
                                            }
                                        ]
                                        '
                    )
                ),
                'migxPromoSc' => array(
                    'category' => $categoryId,
                    'name' => 'migxPromoSc',
                    'caption' => 'Data for promo',
                    'description' => '',
                    'type' => 'migx',
                    'display' => 'default',
                    'input_properties' => array(
                        'formtabs' =>   '
                                        [
                                            {
                                                "caption":"Data for promo", 
                                                "fields": 
                                                [
                                                {
                                                    "field":"title",
                                                    "caption":"Title"
                                                },
                                                {
                                                    "field":"image",
                                                    "caption":"Image",
                                                    "inputTVtype":"image"
                                                },
                                                {
                                                    "field":"link",
                                                    "caption":"Link"
                                                },
                                                {
                                                    "field" : "type",
                                                    "caption":"Type of data",
                                                    "inputTVtype":"option", 
                                                    "inputOptionValues":"Post==1||Video==2"
                                                }
                                                ]
                                            }
                                        ]
                                        ',
                        'columns' =>    '
                                        [
                                            {
                                                "header": "Title", 
                                                "dataIndex": "title"
                                            },
                                            {
                                                "header": "Image", 
                                                "dataIndex": "image",
                                                "renderer": "this.renderImage"
                                            },
                                            {
                                                "header": "Link", 
                                                "dataIndex": "link"
                                            },
                                            {
                                                "header": "Type of data", 
                                                "dataIndex": "type",
                                                "renderer":"this.renderCrossTick"
                                            }
                                        ]
                                        '
                    )
                ),
//                'gallery' => array(
//                    'category' => $categoryId,
//                    'name' => 'gallery',
//                    'caption' => 'Gallery',
//                    'description' => '',
//                    'type' => 'migx',
//                    'display' => 'default',
//                    'input_properties' => array(
//                        'formtabs' => '[{"caption":"Add on image", "fields": [{"field":"title","caption":"Title","inputTV":"galleryImgTitle"},{"field":"image","caption":"Image","inputTV":"galleryImg"}]}]',
//                        'columns' => '[{"header": "Title", "width": "160", "sortable": "true", "dataIndex": "title"},{"header": "Image", "width": "50", "sortable": "false", "dataIndex": "image","renderer": "this.renderImage"}]'
//                    )
//                ),
//                'lineUp' => array(
//                    'category' => $categoryId,
//                    'name' => 'lineUp',
//                    'caption' => 'Line-Up',
//                    'description' => '',
//                    'type' => 'migx',
//                    'display' => 'default',
//                    'input_properties' => array(
//                        'formtabs' => '[{"caption":"Add on person", "fields": [{"field":"name","caption":"Name","inputTV":"lineUpName"},{"field":"location","caption":"Location","inputTV":"lineUpLocation"}]}]',
//                        'columns' => '[{"header": "Name", "width": "140", "sortable": "true", "dataIndex": "name"},{"header": "Location", "width": "70", "sortable": "false", "dataIndex": "location"}]'
//                    )
//                ),
            );

            foreach ($tvs as $k => $v) {
                if(!$tv = $modx->getObject('modTemplateVar', array('name'=>$k))) {
                    $tv = $modx->newObject('modTemplateVar');
                }
                $tv->fromArray($v,'',true,true);

                if(!$tv->save()) {
                    $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not create TV '.$k);
                } else {
                    $modx->log(modX::LOG_LEVEL_INFO,'Create TV '.$k.'.');
                }
            }
        break;
        case xPDOTransport::ACTION_UNINSTALL:
        break;
    }
}

return true;
