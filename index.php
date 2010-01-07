<?php

// Everything has a beginning...

require_once('src/Config.php');
require_once('src/Common.php');
require_once('src/Holder.php');
require_once('src/Dispatcher.php');
require_once('pages/Skeleton.php');

Holder::init();
$app = new AsciiMasterWidget(80);
$skeleton = new Skeleton($app);

require_once(Dispatcher::dispatch());
require_once('pages/Template.php');
