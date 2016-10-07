<?php

$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

require_once 'build.config.php';
// Refresh model
//if (file_exists('build.model.php')) {
//	require_once 'build.model.php';
//}

/* define sources */
$root = dirname(dirname(__FILE__)).'/';
$sources = array(
	'root' => $root,
	'build' => $root . '_build/',
	'data' => $root . '_build/data/',
	'resolvers' => $root . '_build/resolvers/',
    'subpackages' => $root . '_build/subpackages/',
	'docs' => $root.'core/components/'.PKG_NAME_LOWER.'/docs/',
	'source_core' => $root.'core/components/'.PKG_NAME_LOWER,
    'elements_core' => $root.'assets/'.PKG_NAME_LOWER.'-elements/',
    'design_assets' => $root.'assets/'.PKG_NAME_LOWER.'-design/',
    'lexiconfrontend' => $root.'core/components/lexiconfrontend/',
    'source' => $root.'assets/uploads/',
);
unset($root);

require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
require_once $sources['build'] . '/includes/functions.php';

$modx= new modX();
$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO');
$modx->getService('error','error.modError');
$modx->loadClass('transport.modPackageBuilder','',false, true);
if (!XPDO_CLI_MODE) {echo '<pre>';}

$builder = new modPackageBuilder($modx);
if (defined('PKG_AUTO_INSTALL') && !PKG_AUTO_INSTALL) {
    $builder->directory = dirname(dirname(__FILE__)).'/_packages/';
}
$builder->createPackage(PKG_NAME_LOWER,PKG_VERSION,PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER,false,true,PKG_NAMESPACE_PATH);

$modx->log(modX::LOG_LEVEL_INFO,'Created Transport Package and Namespace.');

/* load system settings */
if (defined('BUILD_SETTING_UPDATE')) {
	$settings = include $sources['data'].'transport.settings.php';
	if (!is_array($settings)) {
		$modx->log(modX::LOG_LEVEL_ERROR,'Could not package in settings.');
	} else {
		$attributes= array(
			xPDOTransport::UNIQUE_KEY => 'key',
			xPDOTransport::PRESERVE_KEYS => true,
			xPDOTransport::UPDATE_OBJECT => BUILD_SETTING_UPDATE,
		);
		foreach ($settings as $setting) {
			$vehicle = $builder->createVehicle($setting,$attributes);
			$builder->putVehicle($vehicle);
		}
		$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($settings).' System Settings.');
	}
	unset($settings,$setting,$attributes);
}

/* add propertysets */
if (defined('BUILD_PROPERTY_SETS_UPDATE')) {
    $propertySets = include $sources['data'].'transport.propertysets.php';
    if (!is_array($propertySets)) {
        $modx->log(modX::LOG_LEVEL_FATAL,'No property sets returned.');
    } else {
        $attributes= array(
            xPDOTransport::UNIQUE_KEY => 'name',
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => BUILD_PROPERTY_SETS_UPDATE,
        );
        foreach ($propertySets as $propertySet) {
            $vehicle = $builder->createVehicle($propertySet,$attributes);
            $builder->putVehicle($vehicle);
        }
        $modx->log(modX::LOG_LEVEL_INFO,'Added in '.count($propertySets).' property sets.');
    }
    unset($propertySets,$propertySet,$attributes);
}

/* load plugins events */
if (defined('BUILD_EVENT_UPDATE')) {
	$events = include $sources['data'].'transport.events.php';
	if (!is_array($events)) {
		$modx->log(modX::LOG_LEVEL_ERROR,'Could not package in events.');
	} else {
		$attributes = array (
			xPDOTransport::PRESERVE_KEYS => true,
			xPDOTransport::UPDATE_OBJECT => BUILD_EVENT_UPDATE,
		);
		foreach ($events as $event) {
			$vehicle = $builder->createVehicle($event,$attributes);
			$builder->putVehicle($vehicle);
		}
		$modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' Plugins events.');
	}
	unset ($events, $event, $attributes);
}

/* package in default access policy */
if (defined('BUILD_POLICY_UPDATE')) {
	$attributes = array (
		xPDOTransport::PRESERVE_KEYS => false,
		xPDOTransport::UNIQUE_KEY => array('name'),
		xPDOTransport::UPDATE_OBJECT => BUILD_POLICY_UPDATE,
	);
	$policies = include $sources['data'].'transport.policies.php';
	if (!is_array($policies)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding policies failed.'); }
	foreach ($policies as $policy) {
		$vehicle = $builder->createVehicle($policy,$attributes);
		$builder->putVehicle($vehicle);
	}
	$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($policies).' Access Policies.'); flush();
	unset($policies,$policy,$attributes);
}

/* package in default access policy templates */
if (defined('BUILD_POLICY_TEMPLATE_UPDATE')) {
	$templates = include dirname(__FILE__) . '/data/transport.policies.php';
	$attributes = array (
		xPDOTransport::PRESERVE_KEYS => false,
		xPDOTransport::UNIQUE_KEY => array('name'),
		xPDOTransport::UPDATE_OBJECT => BUILD_POLICY_TEMPLATE_UPDATE,
		xPDOTransport::RELATED_OBJECTS => true,
		xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
			'Permissions' => array (
				xPDOTransport::PRESERVE_KEYS => false,
				xPDOTransport::UPDATE_OBJECT => BUILD_PERMISSION_UPDATE,
				xPDOTransport::UNIQUE_KEY => array ('template','name'),
			),
		)
	);
	if (is_array($templates)) {
		foreach ($templates as $template) {
			$vehicle = $builder->createVehicle($template,$attributes);
			$builder->putVehicle($vehicle);
		}
		$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($templates).' Access Policy Templates.'); flush();
	} else {
		$modx->log(modX::LOG_LEVEL_ERROR,'Could not package in Access Policy Templates.');
	}
	unset ($templates,$template,$attributes);
}

/* package resource groups */
if (defined('BUILD_RESOURCE_GROUP_UPDATE')) {
    $attributes = array (
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UNIQUE_KEY => array('name'),
        xPDOTransport::UPDATE_OBJECT => BUILD_RESOURCE_GROUP_UPDATE,
    );
    $resourceGroups = include $sources['data'].'transport.resourcegroups.php';
    if (!is_array($resourceGroups)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding resource group failed.'); }
    foreach ($resourceGroups as $resourceGroup) {
        $vehicle = $builder->createVehicle($resourceGroup,$attributes);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($resourceGroups).' Resource Groups.'); flush();
    unset($resourceGroups,$resourceGroup,$attributes);
}

/* package roles */
if (defined('BUILD_ROLE_UPDATE')) {
    $attributes = array (
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UNIQUE_KEY => array('name'),
        xPDOTransport::UPDATE_OBJECT => BUILD_ROLE_UPDATE,
    );
    $userGroupRoles = include $sources['data'].'transport.usergrouproles.php';
    if (!is_array($userGroupRoles)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding roles failed.'); }
    foreach ($userGroupRoles as $userGroupRole) {
        $vehicle = $builder->createVehicle($userGroupRole,$attributes);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($userGroupRoles).' Roles.'); flush();
    unset($userGroupRoles,$userGroupRole,$attributes);
}

/* package user groups */
if (defined('BUILD_USER_GROUP_UPDATE')) {
    $attributes = array (
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UNIQUE_KEY => array('name'),
        xPDOTransport::UPDATE_OBJECT => BUILD_USER_GROUP_UPDATE,
    );
    $userGroups = include $sources['data'].'transport.usergroups.php';
    if (!is_array($userGroups)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding user groups failed.'); }
    foreach ($userGroups as $userGroup) {
        $vehicle = $builder->createVehicle($userGroup,$attributes);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($userGroups).' User Groups.'); flush();
    unset($userGroups,$userGroup,$attributes);
}

/* package user groups */
if (defined('BUILD_USER_GROUPS_ROLES_UPDATE')) {
    $attributes = array (
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UNIQUE_KEY => array('name'),
        xPDOTransport::UPDATE_OBJECT => BUILD_USER_GROUPS_ROLES_UPDATE,
    );
    $userGroupRoles = include $sources['data'].'transport.usergrouproles.php';
    if (!is_array($userGroupRoles)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding user group roles failed.'); }
    foreach ($userGroupRoles as $userGroupRole) {
        $vehicle = $builder->createVehicle($userGroupRole,$attributes);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($userGroupRoles).' User Group Roles.'); flush();
    unset($userGroupRoles,$userGroupRole,$attributes);
}

/* package user groups */
if (defined('BUILD_USER_GROUPS_UPDATE')) {
    $attributes = array (
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UNIQUE_KEY => array('name'),
        xPDOTransport::UPDATE_OBJECT => BUILD_USER_GROUP_UPDATE,
    );
    $userGroups = include $sources['data'].'transport.usergroups.php';
    if (!is_array($userGroups)) { $modx->log(modX::LOG_LEVEL_FATAL,'Adding user group failed.'); }
    foreach ($userGroups as $userGroup) {
        $vehicle = $builder->createVehicle($userGroup,$attributes);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($userGroups).' User Groups.'); flush();
    unset($userGroups,$userGroup,$attributes);
}

/* load menus */
if (defined('BUILD_MENU_UPDATE')) {
	$menus = include $sources['data'].'transport.menu.php';
	$attributes = array (
		xPDOTransport::PRESERVE_KEYS => true,
		xPDOTransport::UPDATE_OBJECT => BUILD_MENU_UPDATE,
		xPDOTransport::UNIQUE_KEY => 'text',
		xPDOTransport::RELATED_OBJECTS => true,
		xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
			'Action' => array (
				xPDOTransport::PRESERVE_KEYS => false,
				xPDOTransport::UPDATE_OBJECT => BUILD_ACTION_UPDATE,
				xPDOTransport::UNIQUE_KEY => array ('namespace','controller'),
			),
		),
	);
	if (is_array($menus)) {
		foreach ($menus as $menu) {
			$vehicle = $builder->createVehicle($menu,$attributes);
			$builder->putVehicle($vehicle);
			/* @var modMenu $menu */
			$modx->log(modX::LOG_LEVEL_INFO,'Packaged in menu "'.$menu->get('text').'".');
		}
	}
	else {
		$modx->log(modX::LOG_LEVEL_ERROR,'Could not package in menu.');
	}
	unset($vehicle,$menus,$menu,$attributes);
}

/* create category */
$modx->log(xPDO::LOG_LEVEL_INFO,'Created category.');
/* @var modCategory $category */
$category = $modx->newObject('modCategory');
$category->set('category',PKG_NAME);
/* create category vehicle */
$attr = array(
	xPDOTransport::UNIQUE_KEY => 'category',
	xPDOTransport::PRESERVE_KEYS => false,
	xPDOTransport::UPDATE_OBJECT => true,
	xPDOTransport::RELATED_OBJECTS => true,
);

/* add snippets */
if (defined('BUILD_SNIPPET_UPDATE')) {
	$attr[xPDOTransport::RELATED_OBJECT_ATTRIBUTES]['Snippets'] = array (
		xPDOTransport::PRESERVE_KEYS => false,
		xPDOTransport::UPDATE_OBJECT => BUILD_SNIPPET_UPDATE,
		xPDOTransport::UNIQUE_KEY => 'name',
	);
	$snippets = include $sources['data'].'transport.snippets.php';
	if (!is_array($snippets)) {
		$modx->log(modX::LOG_LEVEL_ERROR,'Could not package in snippets.');
	} else {
		$category->addMany($snippets);
		$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($snippets).' snippets.');
	}
}

/* add chunks subcategories*/
if (defined('BUILD_SUB_CATEGORIES_UPDATE')) {
    $attr[xPDOTransport::RELATED_OBJECT_ATTRIBUTES]['Children'] = array (
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UPDATE_OBJECT => BUILD_SUB_CATEGORIES_UPDATE,
        xPDOTransport::UNIQUE_KEY => 'category',
        xPDOTransport::RELATED_OBJECTS => true,
    );
    $children = include $sources['data'].'transport.subcategories.php';
    if (!is_array($children)) {
        $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in sub category.');
    } else {
        $category->addMany($children, 'Children');
        $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($children).' sub category.');
    }
}

/* add plugins */
if (defined('BUILD_PLUGIN_UPDATE')) {
	$attr[xPDOTransport::RELATED_OBJECT_ATTRIBUTES]['Plugins'] = array (
		xPDOTransport::PRESERVE_KEYS => false,
		xPDOTransport::UPDATE_OBJECT => BUILD_PLUGIN_UPDATE,
		xPDOTransport::UNIQUE_KEY => 'name',
	);
	$attr[xPDOTransport::RELATED_OBJECT_ATTRIBUTES]['PluginEvents'] = array (
		xPDOTransport::PRESERVE_KEYS => true,
		xPDOTransport::UPDATE_OBJECT => BUILD_PLUGIN_UPDATE,
		xPDOTransport::UNIQUE_KEY => array('pluginid','event'),
	);
	$plugins = include $sources['data'].'transport.plugins.php';
	if (!is_array($plugins)) {
		$modx->log(modX::LOG_LEVEL_ERROR,'Could not package in plugins.');
	} else {
		$category->addMany($plugins);
		$modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($plugins).' plugins.');
	}
}

/* add templates */
if (defined('BUILD_TEMPLATE_VARS_UPDATE')) {
    $attr[xPDOTransport::RELATED_OBJECT_ATTRIBUTES]['TemplateVars'] = array (
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UPDATE_OBJECT => BUILD_TEMPLATE_UPDATE,
        xPDOTransport::UNIQUE_KEY => 'name',
    );
    $templateVars = include $sources['data'].'transport.templatevars.php';
    if (!is_array($templateVars)) {
        $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in templates vars.');
    } else {
        $category->addMany($templateVars);
        $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($templateVars).' templates vars.');
    }
}

/* add tvs */
if (defined('BUILD_TEMPLATE_UPDATE')) {
    $attr[xPDOTransport::RELATED_OBJECT_ATTRIBUTES]['Templates'] = array (
        xPDOTransport::PRESERVE_KEYS => false,
        xPDOTransport::UPDATE_OBJECT => BUILD_TEMPLATE_UPDATE,
        xPDOTransport::UNIQUE_KEY => 'templatename',
    );
    $templates = include $sources['data'].'transport.templates.php';
    if (!is_array($templates)) {
        $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in templates.');
    } else {
        $category->addMany($templates);
        $modx->log(modX::LOG_LEVEL_INFO,'Packaged in '.count($templates).' templates.');
    }
}

$vehicle = $builder->createVehicle($category,$attr);

include $sources['data'].'transport.subpackages.php';

/* now pack in resolvers */
//$vehicle->resolve('file',array(
//	'source' => $sources['source_assets'],
//	'target' => "return MODX_ASSETS_PATH . 'components/';",
//));
$vehicle->resolve('file',array(
	'source' => $sources['source_core'],
	'target' => "return MODX_CORE_PATH . 'components/';",
));
$vehicle->resolve('file',array(
    'source' => $sources['design_assets'],
    'target' => "return MODX_ASSETS_PATH;",
));

$vehicle->resolve('file',array(
    'source' => $sources['source'],
    'target' => "return MODX_ASSETS_PATH;",
));

foreach ($BUILD_RESOLVERS as $resolver) {
	if ($vehicle->resolve('php', array('source' => $sources['resolvers'] . 'resolve.'.$resolver.'.php'))) {
		$modx->log(modX::LOG_LEVEL_INFO,'Added resolver "'.$resolver.'" to category.');
	}
	else {
		$modx->log(modX::LOG_LEVEL_INFO,'Could not add resolver "'.$resolver.'" to category.');
	}
}

$vehicle->resolve('file',array(
    'source' => $sources['lexiconfrontend'],
    'target' => "return MODX_CORE_PATH . 'components/';",
));

flush();
$builder->putVehicle($vehicle);

/* now pack in the license file, readme and setup options */
$builder->setPackageAttributes(array(
	'changelog' => file_get_contents($sources['docs'] . 'changelog.txt'),
	'license' => file_get_contents($sources['docs'] . 'license.txt'),
	'readme' => file_get_contents($sources['docs'] . 'readme.txt'),
	'chunks' => $BUILD_CHUNKS,
	'setup-options' => array(
		'source' => $sources['build'].'setup.options.php',
	),
));
$modx->log(modX::LOG_LEVEL_INFO,'Added package attributes and setup options.');

/* zip up package */
$modx->log(modX::LOG_LEVEL_INFO,'Packing up transport package zip...');
$builder->pack();

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);

$signature = $builder->getSignature();
if (defined('PKG_AUTO_INSTALL') && PKG_AUTO_INSTALL) {
	$sig = explode('-',$signature);
	$versionSignature = explode('.',$sig[1]);

	/* @var modTransportPackage $package */
	if (!$package = $modx->getObject('transport.modTransportPackage', array('signature' => $signature))) {
		$package = $modx->newObject('transport.modTransportPackage');
		$package->set('signature', $signature);
		$package->fromArray(array(
			'created' => date('Y-m-d h:i:s'),
			'updated' => null,
			'state' => 1,
			'workspace' => 1,
			'provider' => 0,
			'source' => $signature.'.transport.zip',
			'package_name' => $sig[0],
			'version_major' => $versionSignature[0],
			'version_minor' => !empty($versionSignature[1]) ? $versionSignature[1] : 0,
			'version_patch' => !empty($versionSignature[2]) ? $versionSignature[2] : 0,
		));
		if (!empty($sig[2])) {
			$r = preg_split('/([0-9]+)/',$sig[2],-1,PREG_SPLIT_DELIM_CAPTURE);
			if (is_array($r) && !empty($r)) {
				$package->set('release',$r[0]);
				$package->set('release_index',(isset($r[1]) ? $r[1] : '0'));
			} else {
				$package->set('release',$sig[2]);
			}
		}
		$package->save();
	}

	if ($package->install()) {
		$modx->runProcessor('system/clearcache');
	}
}
if (!empty($_GET['download'])) {
	echo '<script>document.location.href = "/core/packages/' . $signature.'.transport.zip' . '";</script>';
}

$modx->log(modX::LOG_LEVEL_INFO,"\n<br />Execution time: {$totalTime}\n");
if (!XPDO_CLI_MODE) {echo '</pre>';}