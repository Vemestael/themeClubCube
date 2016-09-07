<?php

$userGroups = array();

$tmp = array(
    'Manager' => array(
        'name' => 'Manager',
        'parent' => 0,
    )
);

foreach ($tmp as $k => $v) {
    /* @avr modSnippet $snippet */
    $userGroup = $modx->newObject('modUserGroup');
    $userGroup->fromArray($v,'',true,true);

    $userGroups[] = $userGroup;
}

unset($tmp);
return $userGroups;