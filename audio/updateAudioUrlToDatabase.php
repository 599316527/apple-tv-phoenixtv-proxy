<?php

$content = file_get_contents('php://stdin');

if (empty($content)) exit('No standard input.');

require_once(__DIR__.'/../settings.php');
require_once(LIB_PATH.'class.storage.php');
$storage = Storage::getInstance();

foreach (explode("\n", $content) as $row) {
    if (empty($row)) continue;
    list($guid, $videoUrl) = explode("\t", $row);
    $audioPath =  "audio/data/audio/{$guid}.mp3";
    $hasAudio = file_exists(ROOT_PATH.$audioPath);
    $ret = $storage->update(DB_TABLE_VIDEOS, array(
        'has_audio' => $hasAudio,
        'update_time' => time()
    ), 'guid=:guid', array(
        ':guid' => $guid
    ));
    echo $guid; echo "\t";
    echo $hasAudio ? 'has' : 'has not'; echo ' audio'; echo "\t";
    echo $ret ? 'saved' : 'can not save'; echo ' to database';
}







