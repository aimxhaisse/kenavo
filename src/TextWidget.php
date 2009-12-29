<?php

require_once('Widget.php');

// Simple widget that contains text

class				TextWidget extends Widget
{
  private			$text;

  public function		render()
  {
    return array_split($text, $this->getWidth());
  }

  public function		setText($aText)
  {
    $this->text = $aText;
  }

}
