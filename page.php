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

include(TPL_PATH.'page.tpl.html');
