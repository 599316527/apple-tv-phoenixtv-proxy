<?php

define('ROOT_PATH', dirname(__FILE__).'/');
define('LIB_PATH', ROOT_PATH.'lib/');
define('TPL_PATH', ROOT_PATH.'tpl/');

define('CACHE_PATH', ROOT_PATH.'cache/');
define('CACHE_AGE', 3600 * 6);

define('WEBSITE_PATH', '/tools/atv/apple-tv-phoenixtv-proxy/');
define('STATIC_PATH', WEBSITE_PATH.'static/');

define('DATE_FORMAT', 'Y/m/d H:i:s');
define('MAX_DISPLAY_COUNT', 20);

define('DB_DSN', 'mysql:host=localhost;dbname=atv');
define('DB_TABLE', 'statistics');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');

define('TYPE_VIDEO', 1);
define('TYPE_RSS', 2);
define('TYPE_LIST', 3);

date_default_timezone_set("Asia/Shanghai");

require_once(ROOT_PATH.'config.php');

require_once(LIB_PATH.'class.http.php');
require_once(LIB_PATH.'class.cache.php');
require_once(LIB_PATH.'function.php');
