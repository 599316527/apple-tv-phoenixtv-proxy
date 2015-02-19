<?php

require_once('settings.php');

$key = Query::getParam('program');
$page = Query::getParam('page');

if (!$key) {
    HTTP::throwError('400');
}
if (!isset($_PROGRAMS[$key])) {
    HTTP::throwError('404');
}

if (!$page) {
    $page = 1;
}
$program = $_PROGRAMS[$key];
$title = $program['title'];

increaseCount(TYPE_LIST, $title);

$list = getVideoList($program['column_id'], $page);

if (empty($list)) {
    HTTP::throwError('404', '節目列表為空');
}

include(TPL_PATH.'list.tpl.html');
