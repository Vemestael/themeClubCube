<?php
$url = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
if ($sw == 'facebook')
{
  $api = file_get_contents( 'http://graph.facebook.com/?ids=' . $url );
  $count = json_decode( $api, true);
  $result = $count[$url]['share']['share_count'];
}
elseif($sw == 'twitter')
{
  $api = file_get_contents( 'https://cdn.api.twitter.com/1/urls/count.json?url=' . $url );
  $count = json_decode( $api );
  $result = $count->count;
}
elseif($sw == 'googleplus')
{
  $api = file_get_contents('https://share.yandex.ru/gpp.xml?url='. $url);
  $result = str_replace('"', '', $api);
}
elseif($sw == 'pinterest')
{
  $api = file_get_contents( 'http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=' . $url );
  $body = preg_replace( '/^receiveCount\((.*)\)$/', '\\1', $api );
  $count = json_decode( $body, true );
  //
  $pincount = $modx->cacheManager->get('pinterest_share_count'.$url);
  if ($count['count'] < $pincount) $countPin = $pincount;
  else
  {
    $modx->cacheManager->set('pinterest_share_count'.$url, $count['count'], 7200);
    $countPin = $count['count'];
  }
  $result = $countPin;
}

if (!$result || empty($result))$result=0;
return $result;
