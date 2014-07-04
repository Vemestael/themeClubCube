<?php
if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $userGroups = array(
                'Manager' => array(
                    'modAccessContext' => array(
                        1 => array(
                            'principal' => 'Manager',
                            'principal_class' => 'modUserGroup',
                            'target' => 'mgr', //modContext
                            'policy' => 'Manager', //modAccessPolicy
                            'authority' => 1,
                        ),
                        2 => array(
                            'principal' => 'Manager',
                            'principal_class' => 'modUserGroup',
                            'target' => 'mgr', //modContext
                            'policy' => 'TicketVipPolicy', //modAccessPolicy
                            'authority' => 1,
                        ),
                        3 => array(
                            'principal' => 'Manager',
                            'principal_class' => 'modUserGroup',
                            'target' => 'web', //modContext
                            'policy' => 'Context', //modAccessPolicy
                            'authority' => 9999,
                        ),
                    ),
                    'modAccessResourceGroup' => array(
                        1 => array(
                            'principal' => 'Manager',
                            'principal_class' => 'modUserGroup',
                            'target' => 'technical', //modResourceGroup
                            'policy' => 'Resource', //modAccessPolicy
                            'context_key' => 'web',
                            'authority' => 9999,
                        ),
                    ),
                ),
                'Administrator' => array(
                    'modAccessContext' => array(
                        1 => array(
                            'principal' => 'Administrator',
                            'principal_class' => 'modUserGroup',
                            'target' => 'mgr', //modContext
                            'policy' => 'Administrator', //modAccessPolicy
                            'authority' => 0,
                        ),
                        2 => array(
                            'principal' => 'Administrator',
                            'principal_class' => 'modUserGroup',
                            'target' => 'web', //modContext
                            'policy' => 'Administrator', //modAccessPolicy
                            'authority' => 0,
                        ),
                    ),
                    'modAccessResourceGroup' => array(
                        1 => array(
                            'principal' => 'Administrator',
                            'principal_class' => 'modUserGroup',
                            'target' => 'technical', //modResourceGroup
                            'policy' => 'Resource', //modAccessPolicy
                            'context_key' => 'mgr',
                            'authority' => 0,
                        ),
                        2 => array(
                            'principal' => 'Administrator',
                            'principal_class' => 'modUserGroup',
                            'target' => 'technical', //modResourceGroup
                            'policy' => 'Resource', //modAccessPolicy
                            'context_key' => 'web',
                            'authority' => 9999,
                        ),
                    ),
                    'modAccessCategory' => array(
                        1 => array(
                            'principal' => 'Administrator',
                            'principal_class' => 'modUserGroup',
                            'target' => 'technical', //modResourceGroup
                            'policy' => 'Object', //modAccessPolicy
                            'context_key' => 'mgr',
                            'authority' => 0,
                        ),
                    ),
                    'sources.modAccessMediaSource' => array(
                        1 => array(
                            'principal' => 'Administrator',
                            'principal_class' => 'modUserGroup',
                            'target' => 'Filesystem', //modMediaSource
                            'policy' => 'Media Source Admin', //modAccessPolicy
                            'authority' => 0,
                        ),
                        2 => array(
                            'principal' => 'Administrator',
                            'principal_class' => 'modUserGroup',
                            'target' => 'Filesystem', //modMediaSource
                            'policy' => 'Media Source User', //modAccessPolicy
                            'authority' => 0,
                        ),
                    ),
                ),
                0 => array(
                    'modAccessResourceGroup' => array(
                        1 => array(
                            'principal' => 'Manager',
                            'principal_class' => 'modUserGroup',
                            'target' => 'technical', //modResourceGroup
                            'policy' => 'Load, List and View', //modAccessPolicy
                            'context_key' => 'web',
                            'authority' => 9999,
                        ),
                    ),
                ),
            );

            $group = null;
            foreach($userGroups as $groupName => $access){
                if($groupName !== 0) {
                    $group = $modx->getObject('modUserGroup', array('name' => $groupName))->id;
                } else {
                    $group = 0;
                }

                foreach($access as $targetName => $items) {
//                    $processor = 'security/access/usergroup/' . $targetName . '/create';
                    foreach($items as $item => $v) {
                        $response = null;
                        $request = array();
                        $request = array_merge($v, $request);

                        $request['principal'] = $group;
                        if($targetName == 'modAccessResourceGroup')
                            $request['target'] = $modx->getObject('modResourceGroup',array('name' => $v['target']))->id;
                        elseif($targetName == 'sources.modAccessMediaSource')
                            $request['target'] = $modx->getObject('modMediaSource',array('name' => $v['target']))->id;
                        elseif($targetName == 'modAccessCategory')
                            $request['target'] = $modx->getObject('modCategory',array('category' => $v['target']))->id;

                        $request['policy'] = $modx->getObject('modAccessPolicy',array('name' => $v['policy']))->id;

                        $alreadyExists = $modx->getObject($targetName, $request);

                        if($alreadyExists) $modx->log(modX::LOG_LEVEL_INFO,"Access control for group {$groupName} - {$targetName} already exist.");
                        else {
                            $acl = $modx->newObject($targetName);
                            $acl->fromArray($request);
                            if ($acl->save() == false) {
                                $modx->log(xPDO::LOG_LEVEL_ERROR, $modx->lexicon('access_rgroup_err_save'));
                            } else {
                                $modx->log(modX::LOG_LEVEL_INFO,"Add access control for group {$groupName} - {$targetName}.");
                            }
                        }
                    }
                }

            }
        break;
        case xPDOTransport::ACTION_UNINSTALL:
        break;
    }
}

return true;
