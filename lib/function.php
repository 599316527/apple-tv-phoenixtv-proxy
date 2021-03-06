<?php

function whatTimeIsIt() {
    return date('M j H:i');
}

function object2array($obj) {
    return json_decode(json_encode($obj), true);
}
function array2object($obj) {
    return json_decode(json_encode($obj), false);
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
 * 去重
 * @param  Object $dataList 原始視頻列表
 * @return Object           去重后的視頻列表
 */
function removeDuplicatedVideos($dataList, $append=null) {
    $guids = array();
    $cleaned = (array)$append;
    foreach ($dataList as $episode) {
        $key = $episode->guid;
        if (!isset($guids[$key])) {
            $guids[$key] = true;
            $cleaned[] = $episode;
        }
    }
    return (object)$cleaned;
}

/**
 * 获取广告列表
 * @param  Int    $id
 * @return Array
 */
function getAdList($id) {
    $cache = new Cache("ad/{$id}");
    $json = $cache->read();
    return $json ? $json->dataList : null;
}

/**
 * 获取视频列表
 * @param  Int    $id
 * @param  Int    $page
 * @param  Bool   $hasAd (default: true)
 * @return Array
 */
function getVideoList($id, $page=1, $hasAd=true) {
    $cache = new Cache("list/{$id}-{$page}");
    if ($cache->isExpires()) {
        $guid = CPID . "/{$id}-{$page}";
        $url = str_replace('${guid}', $guid, LIST_URL);
        $ret = cURL($url);
        $ret = substr($ret, 21, -37);
        $json = json_decode($ret);
        if (empty($json->dataList)) {
            if ($cache->postponeExpiration()) {
                echo 'postponeExpiration';
                $json = $cache->read();
            }
        } else {
            $json->dataList = removeDuplicatedVideos(
                $json->dataList,
                $hasAd ? getAdList($id) : array()
            );
            $cache->write($json);
        }
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
    require_once(LIB_PATH.'class.storage.php');
    $db = Storage::getInstance();
    $ret = $db->select(DB_TABLE_STAT, 'guid=:guid AND type=:type', array(
        ':guid' => $guid,
        ':type' => $type
    ), 'id, count');
    if (empty($ret)) {
        $ret = $db->insert(DB_TABLE_STAT, array(
            'type' => $type,
            'guid' => $guid,
            'count' => 1,
            'latest_time' => time()
        ));
    } else {
        $ret = $ret[0];
        $ret = $db->update(DB_TABLE_STAT, array(
            'count' => $ret['count'] + 1,
            'latest_time' => time()
        ), 'id=:id', array(
            ':id' => $ret['id']
        ));
    }
    return $ret;
}

/**
 * 生成符合podcast 要求的 pubDate 格式
 * @param  String $dateStr 2015-11-19
 * @return String          Thu, 19 Nov 2015 23:00:00 +0800
 */
function getPubDate($dateStr) {
    $ret = preg_match('/(\d{4})-(\d{2})-(\d{2})/', $dateStr, $matches);
    if ($ret) {
        $time = mktime(23, 0, 0, $matches[2], $matches[3], $matches[1]);
        return date('r', $time);
    } else {
        return date('r');
    }
}



