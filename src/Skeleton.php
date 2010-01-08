<?php

require_once('src/Ascii.php');
require_once('src/AsciiMasterWidget.php');
require_once('src/AsciiWidgetVertical.php');
require_once('src/AsciiWidgetFile.php');

class			Title extends AsciiWidgetFile
{
  public function	__construct(AsciiBaseWidget $aParent)
  {
    parent::__construct($aParent);
    $this->paddings['left'] = 3;
    $this->paddings['right'] = 3;
    $this->paddings['top'] = 1;
    $this->paddings['bottom'] = 1;
    $this->setFile("data/banner");
  }
}

class			Content extends AsciiWidgetText
{
  public function	__construct(AsciiBaseWidget $aParent)
  {
    parent::__construct($aParent);

    $this->borders['left'] = '+';
    $this->borders['right'] = '+';
    $this->borders['bottom'] = '-';
    $this->borders['top'] = '-';

    $this->paddings['top'] = 1;
    $this->paddings['bottom'] = 1;
    $this->paddings['left'] = 1;
    $this->paddings['right'] = 1;

    $this->margins['top'] = 1;
    $this->margins['bottom'] = 1;
    $this->margins['left'] = 2;
    $this->margins['right'] = 2;
  }
}

class			Article extends AsciiVerticalWidget
{
  private		$article;

  public function	__construct(AsciiBaseWidget $aParent, Entity $aArticle)
  {
    parent::__construct($aParent);

    $this->article = $aArticle;
    $this->margins['left'] = 3;
    $this->margins['right'] = 3;
    $this->margins['top'] = 1;
    $this->margins['bottom'] = 1;

    $this->setTitle();
    $this->setContent();
  }

  private function	setTitle()
  {
    $ascii = new AsciiWidgetText($this);
    $ascii->setText($this->article->getCategory() . '/' . $this->article->getTitle() . "\n");
    $ascii->setText('by ' . $this->article->getAuthor());
    $ascii->setText(' - ' . $this->article->getDate());
    $ascii->setBorders(array('top' => '-',
			     'bottom' => '-'));
    $this->addWidget($ascii);
  }

  private function	setContent()
  {
    $ascii = new AsciiWidgetText($this);
    $ascii->setText($this->article->getContent());
    $this->addWidget($ascii);
  }

}

class			Skeleton extends AsciiVerticalWidget
{
  public function	__construct(AsciiBaseWidget $aParent)
  {
    parent::__construct($aParent);
    $aParent->registerChild($this);
    $this->borders['left'] = '+';
    $this->borders['right'] = '+';
    $this->borders['top'] = '-';
    $this->borders['bottom'] = '-';
    $this->addWidget(new Title($this));
  }
}
