<?php

require_once('src/ModelEntities.php');

function	PageHome(&$skeleton)
{
  $articles = Entities::retrieveGroupedEntities(ARTICLES);
  $itemlist = new ItemList($skeleton);

  $ascii_article = new Article($skeleton, current($articles));
  $skeleton->addWidget($ascii_article);

  while ($article = next($articles))
    {
      $item = new Item($itemlist);
      $item->setText($article->getTitle());
      $itemlist->addWidget($item);
    }

  $skeleton->addWidget($itemlist);
}

PageHome($skeleton);
