<?php

require_once('Widget.php');

// Simple widget that contains text

class				TextWidget extends Widget
{
  private			$text;

  public function		__construct($aWidth = 0)
  {
    parent::__construct($aWidth);
    $this->borders = array('top'	=> '',
			   'left'	=> ' ',
			   'bottom'	=> '',
			   'right'	=> ' ');
  }

  public function		render()
  {
    $result = array();
    $temp = str_split($this->text, $this->getWidth());
    foreach ($temp as $line)
      {
	$result[] = $this->renderLine($line, ' ');
      }

    return $result;
  }

  public function		setText($aText)
  {
    $this->text = $aText;
  }

}
