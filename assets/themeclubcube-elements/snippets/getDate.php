<?php
$properties =& $scriptProperties;

$properties['format'] = !empty($properties['format']) ? $properties['format'] : 'Y-m-d H:i:s';

return date($properties['format']);