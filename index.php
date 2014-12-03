<?php

require_once('settings.php');

increaseCount(TYPE_LIST, 'index');

$wantMore = !!getParam('more');

include(TPL_PATH.'index.tpl.html');
