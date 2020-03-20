<?php
include './vendor/autoload.php';
$a = \Timerange\RangeDate::set(2020,true)->getMonth();
echo '<pre>';
var_dump($a);