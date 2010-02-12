<?php

require_once('src/ModelEntities.php');

function		PageViewAsText($token)
{
  header('content-type: text/html');
  if (($article = Entities::retrieveEntity($token)))
    {
      echo '<pre>' . Ascii::generateHTML($article->getContent()) . '</pre>';
    }
  else
    {
      echo "No matching article found.";
    }
  exit;
}

if (isset($_GET['token']))
  {
    PageViewAsText($_GET['token']);
  }
else
  {
    Common::goToHell();
  }
