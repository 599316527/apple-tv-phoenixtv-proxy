<?php

define('CPID', 'd5f1032b-fe8b-4fbf-ab6b-601caa9480eb');
define('USER_AGENT', 'Mozilla/5.0 (iPad; CPU OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B176 Safari/7534.48.3');
// guid 為 {CPID}/{$column_id}-{$page}
define('LIST_URL', 'http://v.ifeng.com/docvlist/${guid}.js?callback=jsonp6');
define('VIDEO_URL', 'http://dyn.v.ifeng.com/cmpp/video_msg_ipad.js?msg=${guid}&param=playermsg&callback=jsonp3');

// 默認 Podcast 封面
define('PODCAST_ALBUM', 'http://ww4.sinaimg.cn/large/661b7679gw1emljrey8mej218g18g42n.jpg');

$_PROGRAMS = array(
    'kjbfz' => array(
        'title' => '开卷八分钟(停播)',
        'column_id' => '439',
        'album' => 'http://ww3.sinaimg.cn/large/661b7679gw1enumd0emlhj218g18g0xu.jpg'
    ),
    'qqsrx' => array(
        'title' => '锵锵三人行',
        'column_id' => '48',
        'explicit' => true,
        // 'album' => 'http://ww2.sinaimg.cn/large/661b7679gw1en738oqfhxj218g18g0vu.jpg'
        'album' => 'http://ww1.sinaimg.cn/large/661b7679gw1enujz7hgxwj218g18gjtl.jpg'
    ),
    'wdsz' => array(
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
    ),
    'fhzbc' => array(
        'title' => '凤凰早班车',
        'column_id' => '47'
    ),
    'jqgcs' => array(
        'title' => '军情观察室',
        'column_id' => '32'
    ),
    'jscj' => array(
        'title' => '金石财经',
        'column_id' => '7'
    ),
    'ddfhr' => array(
        'title' => '点滴凤凰人',
        'column_id' => '1692'
    ),
);


$_ARCHIVED_PROGRAMS = array(
    'kjbfz'
);




