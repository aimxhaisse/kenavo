<?php

session_start();

// Everything has a beginning...

require_once('src/Config.php');

$time = microtime();

require_once('src/ModelEntities.php');
require_once('src/Common.php');
require_once('src/Holder.php');
require_once('src/Dispatcher.php');
require_once('src/Skeleton.php');
require_once('src/Stat.php');

Holder::init();
Stat::log();
$app = new AsciiMasterWidget(80);
$skeleton = new Skeleton($app);

require_once(Dispatcher::dispatch());
require_once('src/Template.php');
