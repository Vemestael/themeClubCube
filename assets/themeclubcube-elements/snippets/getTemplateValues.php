<?php
//добавить проверку на то, нужно ли вообще
//добавлять класс
try{
	$templateName = $modx->getObject('modTemplate', $id)->get('templatename');	
}catch(Exception $e){
	return;
}

if ($currentChunck == 'eventsSquareItem' && ($templateName == 'indexEvents' || $templateName == 'indexFEvents' || $templateName == 'events'))return 'col-md-4';
if ($currentChunck == 'eventsRectangleItem' && ($templateName == 'indexEvents' || $templateName == 'indexFEvents' || $templateName == 'events'))return 'col-lg-6';
if ($currentChunck == 'eventsSquareList' && ($templateName != 'indexEvents' || $templateName != 'indexFEvents'))return 'col-sm-12';
