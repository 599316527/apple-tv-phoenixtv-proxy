<?php

define('ROOT_PATH', dirname(__FILE__).'/');
define('LIB_PATH', ROOT_PATH.'lib/');
define('TPL_PATH', ROOT_PATH.'tpl/');
define('CACHE_PATH', ROOT_PATH.'cache/');

define('STATIC_PATH', '/tools/atv/apple-tv-phoenixtv-proxy/');

define('USER_AGENT', 'Mozilla/5.0 (iPad; CPU OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B176 Safari/7534.48.3');
define('LIST_URL', 'http://v.ifeng.com/docvlist/${guid}.js?callback=jsonp6');
define('VIDEO_URL', 'http://dyn.v.ifeng.com/cmpp/video_msg_ipad.js?msg=${guid}&param=playermsg&callback=jsonp3');

$_PROGRAMS = array(
    'kjbfz' => array(
        'title' => '開卷八分鐘',
        'guid' => 'd5f1032b-fe8b-4fbf-ab6b-601caa9480eb/439-1'
    ),
    'qqsrx' => array(
        'title' => '鏘鏘三人行',
        'guid' => 'd5f1032b-fe8b-4fbf-ab6b-601caa9480eb/48-1'
    ),
    'fydh' => array(
        'title' => '風雲對話',
        'guid' => 'd5f1032b-fe8b-4fbf-ab6b-601caa9480eb/21-1'
    )
);



date_default_timezone_set("Asia/Shanghai");

require_once(LIB_PATH.'function.php');
