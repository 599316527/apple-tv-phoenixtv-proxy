<?php

require_once('settings.php');

$wantMore = !!getParam('more');

include(TPL_PATH.'index.tpl.html');
