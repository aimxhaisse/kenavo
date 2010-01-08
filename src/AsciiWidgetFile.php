<?php

require_once('src/AsciiWidgetText.php');

class			AsciiWidgetFile extends AsciiWidgetText
{

  public function	__construct(AsciiBaseWidget $parent)
  {
    parent::__construct($parent);
  }

  public function	setFile($aPath)
  {
    $this->setText(file_get_contents($aPath));
  }

}
