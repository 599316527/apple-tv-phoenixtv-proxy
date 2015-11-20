<?php

require_once('../settings.php');

$key = Query::getParam('program');
if (!$key) {
    HTTP::throwError('400');
}

increaseCount(TYPE_RSS, 'audio/' . $key);

header('Content-Type:application/xml; charset=utf-8');
echo file_get_contents(ROOT_PATH .'audio/data/podcast/'. $key .'.xml');
