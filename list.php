<?php

require_once('settings.php');

$key = getParam('program');
$page = getParam('page');

if (!$key) {
    throwError('400');
}
if (!isset($_PROGRAMS[$key])) {
    throwError('404');
}

if (!$page) {
    $page = 1;
}
$program = $_PROGRAMS[$key];
$title = $program['title'];

increaseCount(TYPE_LIST, $title);

$list = getVideoList($program['column_id'], $page);

if (empty($list)) {
    throwError('404', '節目列表為空');
}

include(TPL_PATH.'list.tpl.html');
