<?php

require_once('settings.php');

$key = Query::getParam('program');

if (!$key) {
    HTTP::throwError('400');
}
if (!isset($_PROGRAMS[$key])) {
    HTTP::throwError('404');
}

increaseCount(TYPE_RSS, $key);

if (in_array($key, $_ARCHIVED_PROGRAMS)) {
    HTTP::redirect(WEBSITE_PATH .'archive/rss/'. $key .'.rss.xml');
    exit;
}

$program = $_PROGRAMS[$key];

$title = $program['title'];
$list = getVideoList($program['column_id']);
$explicit = isset($program['explicit']) && $program['explicit'] ? 'yes' : 'clean';
$album = isset($program['album']) ? $program['album'] : PODCAST_ALBUM;

if (empty($list)) {
    HTTP::throwError('404', '節目列表為空');
}

header('Content-Type:application/xml; charset=utf-8');
include(TPL_PATH.'rss.tpl.html');
