<?php

function whatTimeIsIt() {
    return date('M j H:i');
}

function isExistParam($key) {
    return isset($_GET[$key]) && !empty($_GET[$key]);
}

function getParam($key) {
    return isExistParam($key) ? trim($_GET[$key]) : null;
}

/**
 * GET请求
 * @param  String $url 请求的网址
 * @return String      返回的内容
 */
function cURL($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}


/**
 * 获取视频列表
 * @param  String $guid
 * @return Array
 */
function getVideoList($id, $page=1) {
    $cache = new Cache("list/{$id}-{$page}");
    if ($cache->isExpires()) {
        $guid = CPID . "/{$id}-{$page}";
        $url = str_replace('${guid}', $guid, LIST_URL);
        $ret = cURL($url);
        $ret = substr($ret, 21, -37);
        $json = json_decode($ret);
        $cache->write($json);
    } else {
        $json = $cache->read();
    }
    return $json->dataList;
}

/**
 * 获取视频信息
 * @param  String $guid
 * @return Array
 */
function getVideoData($guid) {
    $cache = new Cache('video/' . $guid);
    if ($cache->isExist()) {
        $json = $cache->read();
    } else {
        $url = str_replace('${guid}', $guid, VIDEO_URL);
        $ret = cURL($url);
        $ret = substr($ret, 12, -21);
        $json = json_decode($ret);
        $cache->write($json);
    }
    return $json;
}

/**
 * 統計加 1
 * @param Int $type  統計類型
 * @param String $guid
 * @return Boolean
 */
function increaseCount($type, $guid) {
    require_once(LIB_PATH.'class.db.php');
    $db = new DB(DB_DSN, DB_USERNAME, DB_PASSWORD);
    if (!$db) return 0;
    $ret = $db->select(DB_TABLE, 'guid=:guid AND type=:type', array(
        ':guid' => $guid,
        ':type' => $type
    ), 'id, count');
    if (empty($ret)) {
        $ret = $db->insert(DB_TABLE, array(
            'type' => $type,
            'guid' => $guid,
            'count' => 1,
            'latest_time' => time()
        ));
    } else {
        $ret = $ret[0];
        $ret = $db->update(DB_TABLE, array(
            'count' => $ret['count'] + 1,
            'latest_time' => time()
        ), 'id=:id', array(
            ':id' => $ret['id']
        ));
    }
    return $ret;
}






