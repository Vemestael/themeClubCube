<?php

$userGroupRoles = array();

$tmp = array(
    'Manager' => array(
        'name' => 'Manager',
        'description' => 'Manager site',
        'authority' => 1,
    )
);

foreach ($tmp as $k => $v) {
    /* @avr modSnippet $snippet */
    $userGroupRole = $modx->newObject('modUserGroupRole');
    $userGroupRole->fromArray($v,'',true,true);

    $userGroupRoles[] = $userGroupRole;
}

unset($tmp);
return $userGroupRoles;