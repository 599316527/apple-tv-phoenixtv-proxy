<?php

require_once('settings.php');

$key = getParam('program');

if (!$key) {
    throwError('400');
}
if (!isset($_PROGRAMS[$key])) {
    throwError('404');
}
$program = $_PROGRAMS[$key];

$title = $program['title'];
$list = getVideoList($program['column_id']);
$isExplicit = isset($program['explicit']) && $program['explicit'];
$album = isset($program['album']) ? $program['album'] : PODCAST_ALBUM;

if (empty($list)) {
    throwError('404', '節目列表為空');
}

header('Content-Type:application/xml; charset=utf-8');
include(TPL_PATH.'rss.tpl.html');
