<?php
if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $contentType = $modx->getObject('modContentType',1);
            $contentType->set('file_extensions', '');
            $contentType->save();

            $modx->call('modResource', 'refreshURIs', array(&$modx));
            $modx->log(modX::LOG_LEVEL_INFO,'Update content type HTML.');
        break;
    }
}

return true;
