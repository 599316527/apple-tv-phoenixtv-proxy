<?php

require_once('../settings.php');

$key = Query::getParam('program');
if (!$key) {
    HTTP::throwError('400');
}

increaseCount(TYPE_RSS, 'audio/' . $key);

HTTP::redirect(WEBSITE_PATH .'audio/data/podcast/'. $key .'.xml');
