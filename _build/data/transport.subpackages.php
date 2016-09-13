<?php
/**
* Package in subpackages
*
* @package modxss
*/
$subpackages = array(
    'pdotools' => 'pdotools-1.9.3-pl1',
    'jevix' => 'jevix-1.2.0-pl2',
    'resizer' => 'resizer-1.0.1-pl',
    'dateago' => 'dateago-1.0.2-pl',
    'lexiconfrontend' => 'lexiconfrontend-1.0.1-beta',
    'molt' => 'molt-1.0.2-beta',
    'migx' => 'migx-2.8.1-pl',
    'pthumb' => 'pthumb-2.3.1-pl',
    'tickets' => 'tickets-1.4.2-rc2',
);
$spAttr = array('vehicle_class' => 'xPDOTransportVehicle');

foreach ($subpackages as $name => $signature) {
    $vehicle->resolve('file',array(
        'source' => $sources['subpackages'] . $signature.'.transport.zip',
        'target' => "return MODX_CORE_PATH . 'packages/';",
    ),$spAttr);
}

return true;