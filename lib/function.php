<?php

function whatTimeIsIt() {
    return date('M j H:i');
}

function isExistParam($key) {
    return isset($_GET[$key]) && !empty($_GET[$key]);
}

function getParam($key) {
    return isExistParam($key) ? $_GET[$key] : null;
}

$HTTP_STATUS_TEXT = array(
    '400' => 'Bad Request',
    '403' => 'Forbidden',
    '404' => 'Not Found',
    '500' => 'Internal Server Error'
);
function getHttpStatusTextByCode($code) {
    global $HTTP_STATUS_TEXT;
    return $HTTP_STATUS_TEXT[$code] ? $HTTP_STATUS_TEXT[$code] : '';
}
function throwError($code, $message = '') {
    $text = getHttpStatusTextByCode($code);
    header("HTTP/1.1 {$number} {$text}");
    include(TPL_PATH.'error.tpl.html');
    exit();
}

function redirect($url) {
    header("HTTP/1.1 302 Found");
    header('Location: ' . $url);
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
function getVideoList($guid) {
    $filename = str_replace('/', '-', $guid);
    $cache = new Cache('list/' . $filename);
    if ($cache->isExpires()) {
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
