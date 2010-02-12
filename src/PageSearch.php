<?php

require_once('src/ModelEntities.php');

function		SearchArticles($pattern, $skeleton)
{
  $matches = 0;
  $articles = Entities::retrieveGroupedEntities(ARTICLES);
  $itemlist = new ItemList($skeleton);

  foreach ($articles as $article)
    {
      if (stristr($article->getContent(), $pattern))
	{
	  ++$matches;
	  $link = Common::urlFor('view_article', array('token' => $article->getToken()));
	  $itemlist->setText('<a href="' . $link . '">' . $article->getTitle() . '</a>');
	}
    }

  $skeleton->addWidget($itemlist);
  return $matches;
}

function		PageSearch($skeleton)
{
  global		$_POST;

  if (isset($_POST['pattern']) && strlen($_POST['pattern']))
    {
      $widget = new ItemList($skeleton);
      $pattern = $_POST['pattern'];
      $result = 0;

      $result += SearchArticles($pattern, $skeleton);

      if (0 === $result)
	{
	  $text = new TextContent($skeleton);
	  $text->setText("No matching result :'(\n");
	  $skeleton->addWidget($text);
	}
    }
  else
    {
      Common::goToHell();
    }
}

PageSearch($skeleton);
