<?php

require_once('config.php');

$key = getParam('program');

if (!$key) {
    throwError('400');
}
if (!isset($_PROGRAMS[$key])) {
    throwError('404');
}
$program = $_PROGRAMS[$key];

$title = $program['title'];
$list = getVideoList($program['guid']);

if (empty($list)) {
    throwError('404', '節目列表為空');
}

include(TPL_PATH.'list.tpl.html');
