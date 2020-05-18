<?php
include './vendor/autoload.php';
$a = \Timerange\RangeDate::set([2018,2020],true,'Y-m-d H:i:s')->getWeek(3);
echo '<pre>';
var_dump($a);