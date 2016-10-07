<?php
/**
 * Build the setup options form.
 *
 * @package tickets
 * @subpackage build
 */
$exists = false;
$output = null;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:

    case xPDOTransport::ACTION_UPGRADE:
        $exists =
            $modx->getObject('transport.modTransportPackage', array('package_name' => 'Jevix'))
            && $modx->getObject('transport.modTransportPackage', array('package_name' => 'pdoTools'))
            && $modx->getObject('transport.modTransportPackage', array('package_name' => 'dateAgo'))
            && $modx->getObject('transport.modTransportPackage', array('package_name' => 'lexiconFrontend'))
            && $modx->getObject('transport.modTransportPackage', array('package_name' => 'molt'))
            && $modx->getObject('transport.modTransportPackage', array('package_name' => 'pthumb'))
            && $modx->getObject('transport.modTransportPackage', array('package_name' => 'tickets'))
        ;

        break;

    case xPDOTransport::ACTION_UNINSTALL: break;
}

if (!$exists) {
    switch ($modx->getOption('manager_language')) {
        case 'ru':
            $output = '
                Этот компонент требует:
                <ul>
                    <li><b>Jevix</b></li>
                    <li><b>pdoTools</b></li>
                    <li><b>Tickets</b></li>
                    <li><b>pThumb</b></li>
                    <li><b>resizer</b></li>
                    <li><b>Molt</b></li>
                    <li><b>LexiconFrontend</b></li>
                    <li><b>DateAgo</b></li>
                </ul>
                Могу я автоматически скачать и установить их?
            ';
            break;
        default:
            $output = '
                This component is require:
                <ul>
                    <li><b>Jevix</b></li>
                    <li><b>pdoTools</b></li>
                    <li><b>Tickets</b></li>
                    <li><b>pThumb</b></li>
                    <li><b>resizer</b></li>
                    <li><b>Molt</b></li>
                    <li><b>LexiconFrontend</b></li>
                    <li><b>DateAgo</b></li>
                </ul>
                Can i automaticly download and install them?
            ';
    }
}


if (!$exists) {
    $output .= '<br/><br/>';
}

switch ($modx->getOption('manager_language')) {
    case 'ru':
        $output .=
            '<label for="demo_data">Установить Демо ресурсы?</label>
            <input type="checkbox" name="demo_data" id="demo_data" value="1" />
        ';
        break;
    default:
        $output .=
            '<label for="demo_data">Setup Demo resources?</label>
            <input type="checkbox" name="demo_data" id="demo_data" value="1" />
        ';
}

return $output;