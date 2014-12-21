<?php

require_once('settings.php');

$guid = getParam('guid');

if (!$guid) {
    HTTP::throwError('400');
}

increaseCount(TYPE_VIDEO, $guid);

$data = getVideoData($guid);

if ($data->videoplayurl) {
    HTTP::redirect($data->videoplayurl);
} else {
    HTTP::throwError('404', '沒有獲取到播放地址');
}
