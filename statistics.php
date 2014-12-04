<?php

require_once('settings.php');

$currentType = getParam('type');
$currentType = intval($currentType);
$currentPage = getParam('page');
$currentPage = intval($currentPage);

if (!$currentType || !$currentPage || $currentPage < 1) {
    throwError('400');
}

$title = '統計信息';
$typeList = array('視頻', '播客', '列表');

require_once(LIB_PATH.'class.db.php');
$db = new DB(DB_DSN, DB_USERNAME, DB_PASSWORD);
if (!$db) {
    throwError('500', '连接数据库失败');
}

$ret = $db->select(DB_TABLE, 'type=:type', array(
    ':type' => $currentType
), 'count(*) ct');

if (empty($ret) || $ret[0]['ct'] === 0) {
    throwError('404');
} else {
    $totalRecordCount = $ret[0]['ct'];
}

$totalPages = ceil($totalRecordCount / MAX_DISPLAY_COUNT);
$startCount = ($currentPage - 1) * MAX_DISPLAY_COUNT;
$countNumber = MAX_DISPLAY_COUNT;

// $db->setErrorCallbackFunction('echo');
$records = $db->select(
    DB_TABLE,
    "type=:type ORDER BY latest_time DESC LIMIT {$startCount},{$countNumber}",
    array(':type' => $currentType)
);

if (empty($ret)) {
    throwError('404');
}

include(TPL_PATH.'statistics.tpl.html');
