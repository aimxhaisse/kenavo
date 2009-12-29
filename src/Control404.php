<?php

require_once('src/VWidget.php');
require_once('src/TextWidget.php');

$app = new VWidget(80);

$text = new TextWidget();
$text->setParent($app);
$text->setText("Erreur 404");

$to_print = $app->render();

foreach ($to_print as $line)
  {
    echo $line . "\n";
  }
