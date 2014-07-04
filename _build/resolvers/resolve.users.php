<?php

if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $users = array(
                'Manager' => array(
                    'username' => 'manager',
                    'password' => 'managersite',
                    'profile' => array(
                        'fullname' => 'Manager',
                        'email' => 'manager@manager.site'
                    ),
                    'access' => array(
                        'group' => $modx->getObject('modUserGroup', array('name' => 'Manager'))->id,
                        'role' => $modx->getObject('modUserGroupRole', array('name' => 'Manager'))->id,
                    )
                )
            );

            foreach ($users as $k => $v) {
                /* @avr modSnippet $snippet */
                if (!$user = $modx->getObject('modUser', array('username' => $v['username']))) {
                    $user = $modx->newObject('modUser', $v);
                    $userProfile = $modx->newObject('modUserProfile', $v['profile']);
                    $user->addOne($userProfile);
                } else {
                    $userProfile = $user->getOne('Profile',array('internalKey'=>$user->get('id')));
                    $userProfile->fromArray($v['profile']);
                }

                if ($user->save()) {
                    if (!$user->isMember('Manager') ) {
                        $user->joinGroup($v['access']['group'], $v['access']['role']);
                        $modx->log(modX::LOG_LEVEL_INFO,"Join user to group Manager.");
                    } else $modx->log(xPDO::LOG_LEVEL_ERROR, 'User already joined to group Manager.');
                    $modx->log(modX::LOG_LEVEL_INFO,"Create user {$k}.");
                } else {
                    $modx->log(xPDO::LOG_LEVEL_ERROR, 'Error when saving user '.$k);
                }
            }

        break;
        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;