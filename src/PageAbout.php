<?php

function	PageAbout(&$skeleton)
{
  $content = new AsciiWidgetFile($skeleton);

  $content->setFile(PAGE_ABOUT);
  $content->setMargins(array('left'	=> 2,
			     'right'	=> 02,
			     'top'	=> 1,
			     'bottom'	=> 1));
  $content->setPaddings(array('top'	=> 1,
			      'left'	=> 1,
			      'right'	=> 1,
			      'bottom'	=> 1));
  $content->setBorders(array('top'	=> '-',
			     'left'	=> '+',
			     'right'	=> '+',
			     'bottom'	=> '-'));
  $skeleton->addWidget($content);
}

PageAbout($skeleton);
