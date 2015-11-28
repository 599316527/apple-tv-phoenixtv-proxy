<?php

require_once('settings.php');

$key = Query::getParam('program');
if (!$key) {
    HTTP::throwError('400');
}
if (!isset($_PROGRAMS[$key])) {
    HTTP::throwError('404');
}
$program = $_PROGRAMS[$key];
$cid = $program['column_id'];

require_once(LIB_PATH.'class.storage.php');
$storage = Storage::getInstance();

$items = $storage->select(DB_TABLE_VIDEOS, 'cid=:cid AND has_audio=1', array(
    'cid' => $cid
), 'guid, word_text, link, img, update_time', 'update_time DESC', 30);

if (empty($items)) {
    HTTP::throwError('404');
}

header('Content-Type:application/xml; charset=utf-8');
include(TPL_PATH.'rss/update-log.tpl.html');
