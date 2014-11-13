<?php

define('ROOT_PATH', dirname(__FILE__).'/');
define('LIB_PATH', ROOT_PATH.'lib/');
define('TPL_PATH', ROOT_PATH.'tpl/');

define('CACHE_PATH', ROOT_PATH.'cache/');
define('CACHE_AGE', 3600 * 6);


define('STATIC_PATH', '/tools/atv/apple-tv-phoenixtv-proxy/');


define('CPID', 'd5f1032b-fe8b-4fbf-ab6b-601caa9480eb');
define('USER_AGENT', 'Mozilla/5.0 (iPad; CPU OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B176 Safari/7534.48.3');
// guid 為 {CPID}/{$column_id}-{$page}
define('LIST_URL', 'http://v.ifeng.com/docvlist/${guid}.js?callback=jsonp6');
define('VIDEO_URL', 'http://dyn.v.ifeng.com/cmpp/video_msg_ipad.js?msg=${guid}&param=playermsg&callback=jsonp3');

$_PROGRAMS = array(
    'kjbfz' => array(
        'title' => '開卷八分鐘',
        'column_id' => '439'
    ),
    'qqsrx' => array(
        'title' => '鏘鏘三人行',
        'column_id' => '48'
    ),
    'fydh' => array(
        'title' => '問答神州',
        'column_id' => '20'
    ),
    'zhtfl' => array(
        'title' => '震海听风录',
        'column_id' => '30'
    ),
    'sskj' => array(
        'title' => '时事开讲',
        'column_id' => '46'
    ),
    'zmtx' => array(
        'title' => '筑梦天下',
        'column_id' => '202'
    ),
    'fydh' => array(
        'title' => '風雲對話',
        'column_id' => '21'
    ),
    'hpdfs' => array(
        'title' => '皇牌大放送',
        'column_id' => '203'
    ),
    'wdzgx' => array(
        'title' => '我的中国心',
        'column_id' => '365'
    ),
    'lyyy' => array(
        'title' => '鲁豫有约',
        'column_id' => '40'
    ),
    'mnsfc' => array(
        'title' => '美女私房菜',
        'column_id' => '230'
    ),
    'sjdjt' => array(
        'title' => '世纪大讲堂',
        'column_id' => '37'
    ),
    'zgsdcj' => array(
        'title' => '中国深度财经',
        'column_id' => '1704'
    )
);


date_default_timezone_set("Asia/Shanghai");

require_once(LIB_PATH.'cache.php');
require_once(LIB_PATH.'function.php');
