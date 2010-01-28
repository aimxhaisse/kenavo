<?php

require_once('src/ModelEntities.php');

function		PageViewArticle($skeleton, $token)
{
  if (($article = Entities::retrieveEntity($token)))
    {
      $ascii_article = new Article($skeleton, $article);
      $skeleton->addWidget($ascii_article);
    }
  else
    {
      $text = new TextContent($skeleton);
      $text->addText("No matchin article found :'(");
      $skeleton->addWidget($text);
    }
}

if (isset($_GET['token']))
  {
    PageViewArticle($skeleton, $_GET['token']);
  }
else
  {
    Common::goToHell();
  }
