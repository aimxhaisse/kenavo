<?php

// Everything has a beginning...

require_once('src/Config.php');
require_once('src/Common.php');
require_once('src/Holder.php');
require_once('src/Dispatcher.php');

Holder::init();
Dispatcher::dispatch();
