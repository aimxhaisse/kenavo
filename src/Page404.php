<?php

function	Page404(&$skeleton)
{
  $content = new Content($skeleton);
  $content->setText("Page not found :'(");
  
  $skeleton->addWidget($content);  
}

if (!isset($skeleton))
  {
    Common::goToHell();
  }

Page404($skeleton);
