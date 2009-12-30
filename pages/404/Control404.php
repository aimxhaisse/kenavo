<?php

require_once('src/VWidget.php');
require_once('src/TextWidget.php');

$app = new VWidget();
$app->setWidth(80);

$text = new TextWidget();
$text->setParent($app);
$text->setText("Erreur 404");
