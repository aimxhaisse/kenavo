<?php

require_once('src/ModelEntities.php');

function	PageHome(&$skeleton)
{
  $articles = Entities::retrieveGroupedEntities(ARTICLES);
  
  foreach ($articles as $article)
    {
      $ascii_article = new Article($skeleton, $article);
      $skeleton->addWidget($ascii_article);
    }
}

PageHome($skeleton);
