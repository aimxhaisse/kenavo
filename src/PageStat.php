<?php

require_once('src/Stat.php');

function	PageStat(&$skeleton)
{
  $itemlist = new ItemList($skeleton);
  $db = Stat::loadDb();
  $itemlist->setBorders(array('top' =>		'-',
			      'bottom' =>	'-',
			      'left' =>		'+',
			      'right' =>	'+'));

  $itemlist->setText("Number of page viewed: " . $db['total_pages']);
  $skeleton->addWidget($itemlist);
}

PageStat($skeleton);
