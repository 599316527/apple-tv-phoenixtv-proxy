<?php

require_once('settings.php');

increaseCount(TYPE_LIST, '首頁'));

$wantMore = !!getParam('more');

include(TPL_PATH.'index.tpl.html');
