<?php
include(__DIR__.'/../include/Config.Class.php');
include(__DIR__.'/../include/ImgCache.Class.php');

$IMG = new ImgCache();
$IMG->detach($_GET['f']);