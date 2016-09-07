<?php
/**
 * Плагин для переадресации с url с UpperCase на LoverCase
 */
$eventName = $modx->event->name;

switch($eventName) {
    case 'OnHandleRequest':
        if($modx->context->get('key') != "mgr"){
            if(isset($_GET['rewrite-strtolower-url'])) {
                $url = $_GET['rewrite-strtolower-url'];
                unset($_GET['rewrite-strtolower-url']);
                $params = http_build_query($_GET);
                if(strlen($params)) {
                    $params = '?' . $params;
                }
                $modx->sendRedirect('http://' . $_SERVER['HTTP_HOST'] . '/' . strtolower($url) . $params, array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
            }
        }
        break;
}