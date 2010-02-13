<?php

require_once('src/ModelEntities.php');

function	PageHome(&$skeleton)
{
  $articles = Entities::retrieveGroupedEntities(ARTICLES);
  $itemlist = new ItemList($skeleton);

  $itemlist->setBorders(array('top' =>		'-',
			      'bottom' =>	'-',
			      'left' =>		'+',
			      'right' =>	'+'));

  $ascii_article = new Article($skeleton, current($articles));
  $skeleton->addWidget($ascii_article);

  while ($article = next($articles))
    {
      $text = "[b]" . $article->getCategory() . "[/b]";
      $text.= "/" . $article->getTitle();
      $itemlist->setText($text);
    }

  $skeleton->addWidget($itemlist);
}

PageHome($skeleton);
