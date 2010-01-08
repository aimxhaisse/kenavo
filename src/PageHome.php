<?php

require_once('src/ModelEntities.php');


$articles = Entities::retrieveGroupedEntities('data/articles');

foreach ($articles as $article)
  {
    $ascii_article = new Article($skeleton, $article);
    $skeleton->addWidget($ascii_article);
  }
