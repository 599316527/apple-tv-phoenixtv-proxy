<?php

define('ROOT_PATH', dirname(__FILE__).'/');
define('LIB_PATH', ROOT_PATH.'lib/');
define('TPL_PATH', ROOT_PATH.'tpl/');

define('CACHE_PATH', ROOT_PATH.'cache/');
define('CACHE_AGE', 3600 * 6);

define('STATIC_PATH', '/tools/atv/apple-tv-phoenixtv-proxy/static/');

date_default_timezone_set("Asia/Shanghai");

require_once(ROOT_PATH.'config.php');

require_once(LIB_PATH.'cache.php');
require_once(LIB_PATH.'function.php');
