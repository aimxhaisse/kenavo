<?php

require_once('src/AsciiWidget.php');
require_once('src/Ascii.php');

// Base class for TextWidgets
// Includes BBCODE so as to have a standart way to write everything without
// breaking ascii rules (so easy to have something larger than one charactere in html :P)

class			AsciiWidgetText extends AsciiWidget
{
  private		$text;
  private		$uppercase = false;
  private		$bbcode;

  public function	__construct(AsciiBaseWidget $parent)
  {
    parent::__construct($parent);
  }

  public function	setText($aText)
  {
    $this->text .= Ascii::generateHTML($aText);
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
