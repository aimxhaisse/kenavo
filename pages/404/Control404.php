<?php

require_once('src/AsciiWidgetText.php');

$content = new AsciiWidgetText($app);
$content->setText("Page not found :'(");

$skeleton->addWidget($content);
