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

  $count = 0;

  while ($article = next($articles))
    {
      ++$count;

      $text = "";
      $text.= "[url=";
      $text.= Common::urlFor('view_article',
			     array('token' => $article->getToken())) . ']';
      $text.= "[b]" . $article->getCategory() . "[/b]";
      $text.= "/" . $article->getTitle() . '[/url]';
      $text.= " (" .  $article->getDate() . ")";
      if ($count < count($articles) - 1)
	{
	  $text.= "\n";
	}
      $itemlist->setText($text);
    }

  if ($count > 0)
    {
      $skeleton->addWidget($itemlist);
    }
}

PageHome($skeleton);
