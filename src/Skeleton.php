<?php

require_once('src/Ascii.php');
require_once('src/AsciiMasterWidget.php');
require_once('src/AsciiWidgetVertical.php');
require_once('src/AsciiWidgetFile.php');

class			Title extends AsciiWidgetFile
{
  public function	__construct(AsciiBaseWidget & $aParent)
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
  public function	__construct(AsciiBaseWidget & $aParent)
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

  public function	__construct(AsciiBaseWidget & $aParent, Entity & $aArticle)
  {
    parent::__construct($aParent);

    $this->article = $aArticle;
    $this->margins['left'] = 3;
    $this->margins['right'] = 3;

    $this->setTitle();
    $this->setContent();
    $this->setBottom();
  }

  private function	setBottom()
  {
    $ascii = new AsciiWidgetText($this);
    $text = '--- [[url=' . Common::urlFor('view_as_text', array('token' => $this->article->getToken())) . ']';
    $text.= "[b][color=white]download as html[/color][/b][/url]]";
    $ascii->setText($text);
    $ascii->setMargins(array('bottom' => 1));
    $this->addWidget($ascii);
  }

  private function	setTitle()
  {
    $ascii = new AsciiWidgetText($this);

    $text = '<span class="primary">';
    $text.= $this->article->getCategory() . '/';
    $text.= '<a href="' . Common::urlFor('view_article', array('token' => $this->article->getToken())) . '">';
    $text.= $this->article->getTitle();
    $text.= '</a>' . "\n";
    $text.= '</span>';
    $text.= 'by ' . $this->article->getAuthor() . ', ' . $this->article->getDate();
    $ascii->setText($text);
    $ascii->setBorders(array('top' => '<span class="secondary">-</span>',
			     'bottom' => '<span class="secondary">-</span>'));
    $this->addWidget($ascii);
  }

  public function	getSumUp()
  {
    $result = Ascii::generateHTML($this->article->getContent());
    return $result;
  }

  private function	setContent()
  {
    $ascii = new AsciiWidgetText($this);
    $ascii->setText($this->article->getContent());
    $this->addWidget($ascii);
  }

}

class			TextContent extends AsciiWidgetText
{
  public function	__construct(AsciiBaseWidget & $aParent)
  {
    parent::__construct($aParent);

    $this->paddings['left'] = 1;
    $this->margins['left'] = 1;    
  }
}

class			Item extends AsciiWidgetText
{
  public function	__construct(AsciiBaseWidget & $aParent)
  {
    parent::__construct($aParent);

    $this->borders['left'] = '+';
    $this->paddings['left'] = 1;
    $this->margins['left'] = 1;
  }
}

class			ItemList extends AsciiWidgetText
{
  public function	__construct(AsciiBaseWidget & $aParent)
  {
    parent::__construct($aParent);

    $this->paddings['left'] = 1;
    $this->margins['left'] = 1;
    $this->paddings['right'] = 1;
    $this->margins['right'] = 1;
    $this->margins['bottom'] = 1;
  }

  public function	setText($aText)
  {
    parent::setText("- $aText");
  }
}

class			Skeleton extends AsciiVerticalWidget
{
  public function	__construct(AsciiBaseWidget & $aParent)
  {
    parent::__construct($aParent);
    $aParent->registerChild($this);
    $this->borders['left'] = '<span class="secondary">|</span>';
    $this->borders['right'] = '<span class="secondary">|</span>';
    $this->borders['top'] = '<span class="secondary">|</span>';
    $this->borders['bottom'] = '<span class="secondary">|</span>';
    $this->addWidget(new Title($this));
  }
}
