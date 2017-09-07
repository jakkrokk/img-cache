<?php
error_reporting(E_ALL);
include(__DIR__.'/../include/Config.Class.php');
include(__DIR__.'/../include/ImgCache.Class.php');

$IMG = new ImgCache();
$IMG->test();