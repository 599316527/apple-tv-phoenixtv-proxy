<?php

require_once(__DIR__.'/../settings.php');
require_once(ROOT_PATH.'audio/getProgramCid.inc.php');

$program = $_PROGRAMS[$key];
$title = $program['title'];
$title .= ' 🔊';
$explicit = isset($program['explicit']) && $program['explicit'] ? 'yes' : 'clean';
if (isset($program['audio_album'])) {
    $album = $program['audio_album'];
} elseif (isset($program['album'])) {
    $album = $program['album'];
} else {
    $album = PODCAST_ALBUM;
}

require_once(LIB_PATH.'class.storage.php');
$storage = Storage::getInstance();
$list = $storage->select(DB_TABLE_VIDEOS, 'cid=:cid AND has_audio=1', array(
    ':cid' => $id
), '*', 'image_text DESC', '30');

// header('Content-Type:application/xml; charset=utf-8');
include(TPL_PATH.'rss/audio.tpl.html');




