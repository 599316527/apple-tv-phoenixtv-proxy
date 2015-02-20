<?php

require_once(ROOT_PATH.'audio/getProgramCid.inc.php');

$page = 1;
$cache = new Cache("list/{$id}-{$page}");
$data = $cache->read();
if (empty($data)) exit('No data.');
$list = $data->dataList;
if (empty($list)) exit('Empty list.');
