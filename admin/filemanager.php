<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$tz = new DateTimeZone('Asia/Ho_Chi_Minh');
$tomorrow = date("Y-m-d 00:00:00", strtotime("yesterday")+86400);
$tomorrow = strtotime($tomorrow);

$yesterday = $tomorrow-86400;

$firstDay = new DateTime('first day of this month', $tz);
$firstDay = $firstDay->format("Y-m-d");
$firstDay = strtotime($firstDay);

echo ''.$tomorrow.'<br>'.$yesterday.'<br>'.$firstDay.'';