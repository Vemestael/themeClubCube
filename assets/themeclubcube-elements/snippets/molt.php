<?php
/**
 * molt
 *
 * A minimization js/css and optimization of load time snippet for MODX 2.x.
 *
 * @copyright Copyright (C) 2014, MakeBeCool <developers@makebecool.com>
 * @author Gadashevich Andrei <gav.andrei@makebecool.com>
 * @package BaseTheme
 *
 * TEMPLATES
 *
 * tpl - Template with basic variables JS [default=moltCommon]
 *
 * OPTIONS
 *
 * cacheFolder - (Opt) The folder to the cache files from the site base URL
 * cssFilename - (Opt) Base name for the CSS file [default=styles]
 * cssSources - (Opt) List of comma-separated CSS files to be processed
 * styleHeadSources - (Opt) List of comma-separated CSS files to be processed to include to head style
 * cssPack - (Opt) Enable Minification CSS? [default=true]
 * styleHeadPack - (Opt) Enable Minification CSS? [default=true]
 * cssDeferred - (Opt) Lazy loading CSS file after loading the page [default=false]
 * cssPlaceholder - (Opt) Name placeholder css. Used if &registerCss=`placeholder` [default=Molt.css]
 * styleHeadPlaceholder - (Opt) Name placeholder css. Used if &styleHeadRegister=`placeholder` [default=MoltHead.css]
 * cssRegister - (Opt) Connection CSS : You can save the placeholder (placeholder) or cause the tag "head" (default)
 * styleHeadRegister - (Opt) Connection CSS : You can save the placeholder (placeholder) or cause the tag "head" (default)
 * jsFilename - (opt) Base name for the JS file [default=scripts]
 * jsSources - (Opt) List of comma-separated JS files to be processed
 * jsPack - (Opt) Enable Minification JS [default=true]
 * jsDeferred - (Opt) Lazy loading JS file after loading the page [default=true]
 * jsPlaceholder - (Opt) Name placeholder javascript. Used if &registerJs=`placeholder` [default=Molt.js]
 * jsRegister - (Opt) Connection javascript: You can save the placeholder (placeholder), cause the tag "head" (head)
 * jsInlineSources - (Opt) List of comma-separated JS files to be processed
 * jsInlinePack - (Opt) Enable Minification JS [default=true]
 * jsInlineRegister - (Opt) Connection javascript: You can save the placeholder (placeholder), cause the tag "</body>" (footer)
 * jsInlinePlaceholder - (Opt) Name placeholder javascript. Used if &jsInlineRegister=`placeholder` [default=MoltInline.js]
 * or put before the closing "body" (default) [default=default]
 * jquery - (Opt) Path to the file jquery
 *
 */

/** @var array $scriptProperties */
if (!$modx->getService('molt','Molt',$modx->getOption('molt_core_path',null,$modx->getOption('core_path').'components/themeclubcube/').'model/molt/',$scriptProperties)) {return;}
/** @var Molt $Molt */
if (!$Molt = new Molt($modx, $scriptProperties)) {
    return;
}

$files = $Molt->minify();

/*
 * CSS
 */

//Head section
$styleHeadRegister = $Molt->config['styleHeadRegister'];
$styleHeadPlaceholder = !empty($Molt->config['styleHeadPlaceholder']) ? $Molt->config['styleHeadPlaceholder'] : '';
if($styleHeadRegister == 'placeholder' && $styleHeadPlaceholder) {
    $modx->setPlaceholder($styleHeadPlaceholder, $files['styleHead']);
} elseif($styleHeadRegister == 'head') {
    $modx->regClientStartupHTMLBlock($files['styleHead']);
}

//css file
$cssDeferred = ($Molt->config['cssDeferred']) ? 1 : 0;
$cssRegister = $Molt->config['cssRegister'];
$cssPlaceholder = !empty($Molt->config['cssPlaceholder']) ? $Molt->config['cssPlaceholder'] : '';
if($cssRegister == 'placeholder' && $cssPlaceholder) {
    $tag = '<link rel="stylesheet" href="' . $files['css'] . '" type="text/css" >';
    $modx->setPlaceholder($cssPlaceholder, $tag);
} elseif($cssRegister == 'head' && !$cssDeferred) {
    $modx->regClientCSS($files['css']);
}

/*
 * JS
 */
$jsRegister = $Molt->config['jsRegister'];
$jsPlaceholder = !empty($Molt->config['jsPlaceholder']) ? $Molt->config['jsPlaceholder'] : '';

$properties = array(
    'jsDeferred' => $Molt->config['jsDeferred'] ? 1 : 0
    ,'cssDeferred' => $Molt->config['cssDeferred'] ? 1 : 0
    ,'jsUrl' => $files['js']
    ,'cssUrl' => $files['css']
    ,'jquerySource' => $Molt->config['jquery']
);
$jsDeferred = $Molt->config['jsDeferred'] ? 1 : 0;
$jsVar = $modx->getChunk($Molt->config['tpl'],$properties);

if($jsRegister == 'placeholder' && $jsPlaceholder) {
    $tag = '<script src="' . $files['js'] . '"></script>';
    $modx->setPlaceholder($jsPlaceholder, $tag);
} elseif($jsRegister == 'head') {
    $modx->regClientStartupHTMLBlock($jsVar);
    if(!$jsDeferred) {
        $modx->regClientStartupScript($files['js']);
    }
} else {
    $modx->regClientHTMLBlock($jsVar);
    if(!$jsDeferred) {
        $modx->regClientScript($files['js']);
    }
}

if($jsDeferred) {
    $modx->regClientScript($Molt->getDeferredFunction());
}

/*
 * JS INLINE
 */
$jsInlineRegister = $Molt->config['jsInlineRegister'];
$jsInlinePlaceholder = !empty($Molt->config['jsInlinePlaceholder']) ? $Molt->config['jsInlinePlaceholder'] : '';

if($jsInlineRegister == 'placeholder' && $jsInlinePlaceholder) {
    $tag = '<script src="' . $files['jsInline'] . '"></script>';
    $modx->setPlaceholder($jsInlinePlaceholder, $tag);
} else {
    $modx->regClientScript($files['jsInline']);
}