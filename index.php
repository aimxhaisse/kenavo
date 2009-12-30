<?php

// Everything has a beginning...

require_once('src/Config.php');
require_once('src/VWidget.php');
require_once('src/Common.php');
require_once('src/Holder.php');
require_once('src/Dispatcher.php');

Holder::init();

$app = new VWidget();
$app->setWidth(WIDTH);

require_once(Dispatcher::dispatch());
require_once('pages/Template.php');
