<?php

// Everything has a beginning...

require_once('src/Config.php');
require_once('src/Common.php');
require_once('src/Request.php');
require_once('src/Dispatcher.php');

if (Dispatcher::dispatch() === false)
  {
    Common::fatal_error('Requested page doesn\'t exists');
  }
