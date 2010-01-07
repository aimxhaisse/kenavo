<?php

require_once('src/AsciiWidget.php');
require_once('src/Ascii.php');

class			AsciiWidgetText extends AsciiWidget
{
  private		$text;

  public function	__construct(AsciiBaseWidget $parent)
  {
    parent::__construct($parent);
  }

  public function	setText($aText)
  {
    $this->text .= $aText;
  }

  public function	render()
  {
    $result = array();
    $lines = explode("\n", $this->text);

    foreach ($lines as $line)
      {
	$result = array_merge(str_split($line, $this->getWidth()), $result);
      }
    return parent::renderContent($result);
  }
}
