<?php

require_once('Widget.php');

// Simple widget that contains text, like this:
//
// |----------|
// | Text     |
// |----------|

class				TextWidget extends Widget
{
  private			$text;

  // Simple constructor that take a default text

  public function		__construct($aText = "")
  {
    $this->text = $aText;
  }

  // Simply returns a splitted array containing the text
  // to be displayed

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

  // We can EVEN change the text after its initialization, that's amazing

  public function		setText($aText)
  {
    $this->text = $aText;
  }

}
