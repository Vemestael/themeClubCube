<?php
/**
 * Resolves setup-options settings
 *
 * @var xPDOObject $object
 * @var array $options
 */

if ($object->xpdo) {
	/* @var modX $modx */
	$modx =& $object->xpdo;

	$success= false;
	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
		case xPDOTransport::ACTION_UPGRADE:
			/* Checking and installing required packages */
			$packages = array(
				'pdoTools' => array(
                    'signature' => 'pdotools-1.9.2-pl2',
                    'options' => array(
                        'version_major' => 1,
                        'version_minor:>=' =>  9,
                    )
                ),
                'jevix' => array(
                    'signature' => 'jevix-1.2.0-pl2',
                    'options' => array(
                        'version_major' => 1,
                        'version_minor:>=' =>  2,
                    )
                ),
                'resizer' => array(
                    'signature' => 'resizer-1.0.1-pl',
                    'options' => array(
                        'version_major' => 1,
                        'version_minor:>=' =>  0,
                    )
                ),
                'dateAgo' => array(
                    'signature' => 'dateago-1.0.2-pl',
                    'options' => array(
                        'version_major' => 1,
                        'version_minor:>=' =>  0,
                    )
                ),
                'lexiconFrontend' => array(
                    'signature' => 'lexiconfrontend-1.0.1-beta',
                    'options' => array(
                        'version_major' => 1,
                        'version_minor:>=' =>  0,
                    )
                ),
                'molt' => array(
                    'signature' => 'molt-0.0.1-beta',
                    'options' => array(
                        'version_major' => 0,
                        'version_minor:>=' =>  0,
                    )
                ),
                'pthumb' => array(
                    'signature' => 'pthumb-2.3.1-pl',
                    'options' => array(
                        'version_major' => 2,
                        'version_minor:>=' =>  3,
                    )
                ),
                'tickets' => array(
                    'signature' => 'tickets-1.4.0-pl',
                    'options' => array(
                        'version_major' => 1,
                        'version_minor:>=' =>  4,
                    )
                ),
			);
			foreach ($packages as $package => $opt) {
				$query = array('package_name' => $package);
				if (!empty($opt)) {$query = array_merge($query, $opt['options']);}
				if (!$modx->getObject('transport.modTransportPackage', $query)) {
					$modx->log(modX::LOG_LEVEL_INFO, 'Trying to install <b>'.$package.'</b>. Please wait...');

					$response = installPackageComponent($package,$opt['signature']);
					if ($response['success']) {$level = modX::LOG_LEVEL_INFO;}
					else {$level = modX::LOG_LEVEL_ERROR;}

					$modx->log($level, $response['message']);
				}
			}
			$success = true;
			break;

		case xPDOTransport::ACTION_UNINSTALL:
			$success = true;
			break;
	}

	return $success;
}



/**
 * @param $packageName
 *
 * @return array|bool
 */
function installPackageComponent($packageName, $signature) {
	global $modx, $sources;

    if(!is_null($signature)){
        $sig = explode('-',$signature);
        $versionSignature = explode('.',$sig[1]);

        if(addPackage($signature, 0, $sig, $versionSignature)) {
            return array(
                'success' => 1,
                'message' => '<b>'.$packageName.'</b> was successfully installed',
            );
        }
        else {
            return array(
                'success' => 0,
                'message' => 'Could not save package <b>'.$packageName.'</b>',
            );
        }
    } else {
        /* @var modTransportProvider $provider */
        $provider = $modx->getObject('transport.modTransportProvider', 1);

        $provider->getClient();
        $modx->getVersionData();
        $productVersion = $modx->version['code_name'].'-'.$modx->version['full_version'];

        $response = $provider->request('package','GET',array(
            'supports' => $productVersion,
            'query' => $packageName
        ));

        if(!empty($response)) {
            $foundPackages = simplexml_load_string($response->response);
            foreach($foundPackages as $foundPackage) {
                /* @var modTransportPackage $foundPackage */
                if($foundPackage->name == $packageName) {
                    $sig = explode('-',$foundPackage->signature);
                    $versionSignature = explode('.',$sig[1]);
                    $url = $foundPackage->location;

                    if (!downloadComponent($url, $modx->getOption('core_path').'packages/'.$foundPackage->signature.'.transport.zip')) {
                        return array(
                            'success' => 0,
                            'message' => 'Could not download package <b>'.$packageName.'</b>.',
                        );
                    }

                    if(addPackage($foundPackage->signature, $provider->id, $sig, $versionSignature)) {
                        return array(
                            'success' => 1,
                            'message' => '<b>'.$packageName.'</b> was successfully installed',
                        );
                    }
                    else {
                        return array(
                            'success' => 0,
                            'message' => 'Could not save package <b>'.$packageName.'</b>',
                        );
                    }
                    break;
                }
            }
        }
        else {
            return array(
                'success' => 0,
                'message' => 'Could not find <b>'.$packageName.'</b> in MODX repository',
            );
        }
    }

	return true;
}

function addPackage($signature, $provideId, $sig, $versionSignature){
    global $modx;
    /* add in the package as an object so it can be upgraded */
    /** @var modTransportPackage $package */
    $package = $modx->newObject('transport.modTransportPackage');
    $package->set('signature',$signature);
    $package->fromArray(array(
        'created' => date('Y-m-d h:i:s'),
        'updated' => null,
        'state' => 1,
        'workspace' => 1,
        'provider' => $provideId,
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

    if($package->save() && $package->install()) {
        return true;
    }
    else {
        return false;
    }
}


/**
 * @param $src
 * @param $dst
 *
 * @return bool
 */
function downloadComponent($src, $dst) {
	if (ini_get('allow_url_fopen')) {
		$file = @file_get_contents($src);
	}
	else if (function_exists('curl_init')) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $src);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,180);
		$safeMode = @ini_get('safe_mode');
		$openBasedir = @ini_get('open_basedir');
		if (empty($safeMode) && empty($openBasedir)) {
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		}

		$file = curl_exec($ch);
		curl_close($ch);
	}
	else {
		return false;
	}
	file_put_contents($dst, $file);

	return file_exists($dst);
}
