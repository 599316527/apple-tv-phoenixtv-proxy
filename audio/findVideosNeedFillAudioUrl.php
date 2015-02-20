<?php

require_once(__DIR__.'/../settings.php');
require_once(ROOT_PATH.'audio/getVideoList.inc.php');
require_once(LIB_PATH.'class.storage.php');
$storage = Storage::getInstance();

foreach ($list as $video) {
    $guid = $video->guid;
    $ret = $storage->select(DB_TABLE_VIDEOS, 'guid=:guid AND has_audio=0', array(
        ':guid' => $guid
    ), 'video_url');
    if (!empty($ret) && $ret[0]['video_url']) {
        echo $guid; echo "\t";
        echo $ret[0]['video_url']; echo "\n";
    }
}
