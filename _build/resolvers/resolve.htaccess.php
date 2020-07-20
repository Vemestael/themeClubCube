<?php
/**
 * Resolve overwriting chunks
 *
 * @var xPDOObject $object
 * @var array $options
 */

$htaccesMain =
"AddDefaultCharset utf-8
Options +FollowSymlinks
RewriteEngine On
RewriteBase ".MODX_BASE_URL."

# Rewrite www.domain.com -> domain.com
RewriteCond %{HTTP_HOST} ^www.example.com$
RewriteRule ^(.*)$ http://example.com/$1 [R=301,L]

# force url to lowercase if upper case is found
RewriteCond %{REQUEST_URI} [A-Z]
# ensure it is not a file on the drive first
RewriteCond %{REQUEST_FILENAME} !-s
RewriteRule (.*) index.php?rewrite-strtolower-url=$1 [QSA,L]


# Rewrite index.php -> /
RewriteCond %{THE_REQUEST} ^[A-Z]{3,}\s(.*)/index\.php [NC]
RewriteRule ^ %1 [R=301,L]

# Remove trailing slash
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)/$ /$1 [L,R=301]

# Remove many trailing slash
RewriteCond %{THE_REQUEST} //
RewriteRule .* $1 [L,R=301]

# The Friendly URLs part
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?q=$1 [L,QSA]

#Caching include if not config in server
#Header set Cache-Control 'max-age=2592000'

# For servers that support output compression, you should pick up a bit of
# speed by un-commenting the following lines.
#include if not config in server
#php_flag zlib.output_compression On
#php_value zlib.output_compression_level 5";

$htaccesAssets =
"RewriteEngine Off
Options -Indexes";

if ($object->xpdo) {
	/* @var modX $modx */
	$modx =& $object->xpdo;

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
		case xPDOTransport::ACTION_UPGRADE:
			if(!file_exists(MODX_ASSETS_PATH.'.htaccess')) {
                file_put_contents(MODX_ASSETS_PATH.'.htaccess', $htaccesAssets);
            }
            if(!file_exists(MODX_CONNECTORS_PATH.'.htaccess')) {
                file_put_contents(MODX_CONNECTORS_PATH.'.htaccess', $htaccesAssets);
            }
            if(!file_exists(MODX_MANAGER_PATH.'.htaccess')) {
                file_put_contents(MODX_MANAGER_PATH.'.htaccess', $htaccesAssets);
            }
            if(!file_exists(MODX_BASE_PATH.'.htaccess')) {
                file_put_contents(MODX_BASE_PATH.'.htaccess', $htaccesMain);
            } else {
                rename(MODX_BASE_PATH.'.htaccess', MODX_BASE_PATH.'old.htaccess');
                file_put_contents(MODX_BASE_PATH.'.htaccess', $htaccesMain);
            }
        break;

		case xPDOTransport::ACTION_UNINSTALL:
        break;
	}
}
return true;