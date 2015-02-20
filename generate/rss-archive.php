<?php

/**
 * 生成全部的節目RSS列表
 */

require_once(__DIR__ . '/../settings.php');

$key = Query::getParam('program');

if (!$key) {
    HTTP::throwError('400');
}
if (!isset($_PROGRAMS[$key])) {
    HTTP::throwError('404');
}

$program = $_PROGRAMS[$key];
$title = $program['title'];
$columnId = $program['column_id'];
$explicit = isset($program['explicit']) && $program['explicit'] ? 'yes' : 'clean';
$album = isset($program['album']) ? $program['album'] : PODCAST_ALBUM;

$list = array();
$page = 1;
while ($episode = getVideoList($columnId, $page++)) {
    $episode = object2array($episode);
    if (empty($episode)) break;
    $list = array_merge($list, $episode);
    // if ($page > 3) break;
    sleep(mt_rand(1, 3));   // 防止請求過於頻繁
}

$list = array2object($list);

header('Content-Type:text/plain; charset=utf-8');
include(TPL_PATH.'rss.tpl.html');



