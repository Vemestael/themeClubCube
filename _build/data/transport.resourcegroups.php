<?php

$resourceGroups = array();

$tmp = array(
	'technical',
);

foreach ($tmp as $k) {
	/* @avr modSnippet $snippet */
    $resourceGroup = $modx->newObject('modResourceGroup');
    $resourceGroup->fromArray(array(
		'name' => $k,
	),'',true,true);


    $resourceGroups[] = $resourceGroup;
}

unset($tmp);
return $resourceGroups;