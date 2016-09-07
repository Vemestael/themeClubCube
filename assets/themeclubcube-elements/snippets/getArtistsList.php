<?php
$artists = json_decode($artistsList, true);
foreach($artists["content"] as $artist)
{
  echo ' 	<li>
           	<p>'.$artist[name].'</p>
           	<span>'.$artist[city].'</span>
         	</li>';
}