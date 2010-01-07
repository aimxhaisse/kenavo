<?php

require_once('src/AsciiWidget.php');

// V is for Vertical Widget ! Like this one:
//
// |--------------|
// | Sub Widget   |
// | Another one  |
// | And another !|
// |--------------|
//
//                 (yeah, that's ugly.)

class				AsciiVerticalWidget extends AsciiWidget
{
  private			$children;

  // Let's construct that Widget with the following borders

  public function		__construct(AsciiBaseWidget $parent)
  {
    parent::__construct($parent);

    $this->borders['top'] =	'-';
    $this->borders['bottom'] =	'-';
    $this->borders['left'] =	'|';
    $this->borders['right'] =	'|';
  }

  // Register a new children to be rendered by the widget

  public function		addWidget(AsciiWidget $aChild)
  {
    $this->children[] = $aChild;
  }

  // Main stuff is made here, returns a string representing
  // Widget's content. Kind of recursion.

  public function		render()
  {
    $width = $this->getWidth();
    $result = array();

    foreach ($this->children as $widget)
      {
	$result = array_merge($result, $widget->render());      
      }

    return parent::renderContent($result);
  }

}
