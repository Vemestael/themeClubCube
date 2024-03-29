<?php
/**
 * Плагин для смены цветовой схемы
 */
$eventName = $modx->event->name;

switch($eventName) {
    case 'OnWebPageInit':
        if($modx->context->get('key') != "mgr"){
            if(isset($_GET['color']) || isset($_SESSION['color'])) {
                $color = $_GET['color'] ? $_GET['color'] : $_SESSION['color'];
                $colors = array('brown-gray', 'crimson-cyan', 'green-violet', 'orange-red', 'yellow-pink');
                if(!in_array($color, $colors)) {
                    continue;
                }
                $_SESSION['color'] = $color;

                $modx->regClientCSS($modx->getOption('themeclubcube.design_url').'css/skins/clr-'.$color.'.css');
                $cm = $modx->getCacheManager();
                $cm->refresh();
            } else {
                $color = 'green-violet';
            }
            $modx->setPlaceholder('color', $color);
        }
        break;
    case 'OnLoadWebDocument':
        if(isset($_GET['color'])) {
            $url = $modx->makeUrl($modx->resource->get('id'));
            $modx->sendRedirect($url);
        }
        break;
}