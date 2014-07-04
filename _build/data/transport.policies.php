<?php

$policies = array();

$tmp = array(
    'AdministratorTemplate' => array(
        'Manager' => array(
            'description' => 'Context administration policy with limited, content-editing related Permissions and publishing.',
            'data' => array(
                'change_password' => true,
                'change_profile' => true,
                'class_map' => true,
                'components' => true,
                'countries' => true,
                'delete_document' => true,
                'directory_create' => true,
                'directory_list' => true,
                'directory_remove' => true,
                'directory_update' => true,
                'edit_document' => true,
                'empty_cache' => true,
                'file_create' => true,
                'file_list' => true,
                'file_manager' => true,
                'file_remove' => true,
                'file_tree' => true,
                'file_update' => true,
                'file_upload' => true,
                'file_view' => true,
                'frames' => true,
                'help' => true,
                'home' => true,
                'languages' => true,
                'lexicons' => true,
                'load' => true,
                'list' => true,
                'logout' => true,
                'menu_reports' => true,
                'menu_site' => true,
                'menu_user' => true,
                'namespaces' => true,
                'new_document' => true,
                'publish_document' => true,
                'purge_deleted' => true,
                'resource_duplicate' => true,
                'resource_tree' => true,
                'save_document' => true,
                'source_view' => true,
                'tree_show_resource_ids' => true,
                'undelete_document' => true,
                'unpublish_document' => true,
                'view' => true,
                'view_document' => true,
                'view_unpublished' => true,
            ),
            'parent' => 0,
            'class' => '',
        ),
    )
);

foreach($tmp as $t => $p) {
    $template = $modx->getObject('modAccessPolicyTemplate',array('name' => $t));
    if (!$template) {
        $modx->log(xPDO::LOG_LEVEL_ERROR, "Core AccessPolicyTemplate $t is missing! Could not resolve AccessPolicy.");
        continue;
    }
    foreach ($p as $k => $v) {
        if (isset($v['data'])) {
            $v['data'] = $modx->toJSON($v['data']);
        }

        /* @var $policy modAccessPolicy */
        $policy = $modx->newObject('modAccessPolicy');
        $policy->fromArray(array_merge(array(
                'name' => $k,
                'lexicon' => 'permissions',
                'template' => $template->get('id')
            ), $v)
            ,'', true, true);

        $policies[] = $policy;
    }
}

return $policies;