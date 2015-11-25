<?php

require_once(__DIR__.'/../settings.php');
require_once(ROOT_PATH.'audio/getVideoList.inc.php');
require_once(LIB_PATH.'class.storage.php');
$storage = Storage::getInstance();

echo 'Saving videos to database'; echo "\n";
foreach ($list as $video) {
    // save video data to db
    $ret = $storage->insert(DB_TABLE_VIDEOS, array(
        'cid' => $id,
        'guid' => $video->guid,
        'title' => $video->title,
        'word_text' => $video->wordText,
        'image_text' => $video->imageText,
        'link' => $video->link,
        'img' => $video->img,
        'update_time' => time()
    ));
    /////////////////////////////////////
    echo $video->title; echo "\t";
    echo $ret ? 'YES' : 'NO'; echo "\n";
}

echo "\n"; echo 'Updating videos\' urls'; echo "\n";
foreach ($list as $video) {
    $guid = $video->guid;
    $ret = $storage->select(DB_TABLE_VIDEOS, 'guid=:guid', array(
        ':guid' => $guid
    ), 'video_url');
    echo $video->title; echo "\t";
    if (empty($ret)) {
        echo 'does not exist.';
    } else if ($ret[0]['video_url']) {
        echo 'has had video_url.';
    } else {
        $data = getVideoData($guid);    // @see lib/function.php
        if (empty($data)) {
            echo 'can not access its video url.';
        } else {
            // Save video url
            if ($data->videoplayurl) {
                $ret = $storage->update(DB_TABLE_VIDEOS, array(
                    'img' => $data->largePoster,
                    'video_url' => $data->videoplayurl,
                    'update_time' => time()
                ), 'guid=:guid', array(
                    ':guid' => $guid
                ));
            } else {
                $ret = false;
            }
            echo $ret ? 'has saved' : 'can not save'; echo ' video url';
        }
    }
    echo "\n";
}









