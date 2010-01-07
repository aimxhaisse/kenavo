<?php

require_once('src/Ascii.php');
require_once('src/AsciiMasterWidget.php');
require_once('src/AsciiVerticalWidget.php');
require_once('src/AsciiWidgetText.php');

class			Title extends AsciiWidgetText
{
  public function	__construct(AsciiBaseWidget $aParent)
  {
    parent::__construct($aParent);
    $this->setText(TITLE);
    $this->borders['left'] = '###';
    $this->borders['right'] = '###';
    $this->borders['top'] = '###';
    $this->borders['bottom'] = '###';
    $this->margins['left'] = 3;
    $this->margins['right'] = 3;
    $this->margins['top'] = 3;
    $this->margins['bottom'] = 3;
    $this->paddings['left'] = 3;
    $this->paddings['right'] = 3;
    $this->paddings['top'] = 3;
    $this->paddings['bottom'] = 3;
  }
}

class			Skeleton extends AsciiVerticalWidget
{
  public function	__construct(AsciiBaseWidget $aParent)
  {
    parent::__construct($aParent);
    $aParent->registerChild($this);
    $this->addWidget(new Title($this));
  }
}
