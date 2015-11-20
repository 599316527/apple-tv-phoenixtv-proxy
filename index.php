<?php

require_once('settings.php');

increaseCount(TYPE_LIST, '首頁');

$wantMore = !!Query::getParam('more');
$showRss = !!Query::getParam('rss');

include(TPL_PATH.'index.tpl.html');
