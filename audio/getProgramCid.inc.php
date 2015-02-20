<?php

$key = Query::getParam('program');
if (empty($key)) exit('No program specified.');
if (!isset($_PROGRAMS[$key])) exit('The program specified does not exist.');
$id = $_PROGRAMS[$key]['column_id'];

