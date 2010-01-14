<?php

require_once('src/AsciiWidget.php');
require_once('src/Ascii.php');

class			AsciiWidgetText extends AsciiWidget
{
  private		$text;
  private		$uppercase = false;

  public function	__construct(AsciiBaseWidget $parent)
  {
    parent::__construct($parent);
  }

  public function	setText($aText)
  {
    $this->text .= $aText;
  }

  public function	setUpperCase()
  {
    $this->uppercase = true;
  }

  public function	render()
  {
    $result = array();
    $lines = explode("\n", $this->text);
    $width = $this->getWidth();

    foreach ($lines as $line)
      {
	if ($this->uppercase)
	  {
	    $line = strtoupper($line);
	  }
	$result[] = $line;
      }

    return parent::renderContent($result);
  }
}
