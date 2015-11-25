<?php

require_once('settings.php');

$guid = Query::getParam('guid');

if (!$guid) {
    HTTP::throwError('400');
}

increaseCount(TYPE_VIDEO, $guid);

$data = getVideoData($guid);

if ($data->videoplayurl) {
    if (Query::getParam('player')) {
        $title = $data->columnName;
        unset($data->_write_time);
        $data->timeOff = intval(Query::getParam('ss'));
        $videoData = json_encode($data, JSON_PRETTY_PRINT);
        include(TPL_PATH.'player.tpl.html');
    } else {
        HTTP::redirect($data->videoplayurl);
    }
} else {
    HTTP::throwError('404', '沒有獲取到播放地址');
}
