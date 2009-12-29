<?php

require_once('Common.php');

// Qt Style Widget (or not really :D)
//
// V is for Vertical Widget !
//
// We don't allow someone to set the width/height of the widget, only
// the width is checked and used in the rendering. We can't change width/height
// of the widget, you have to tell it during construction, that's all.
//
// If you set the current widget to be the child a parent one, width of the current
// widget is likely to be changed, so as to fit in parent's container

class				VWidget
{
  private			$parent = false;
  private			$content = false;
  private			$width = 0;
  private			$children = array();
  private			$borders = array('top'		=> '-',
						 'left'		=> '|',
						 'bottom'	=> '-',
						 'right'	=> '|');

  // Okay let's create a new Widget, basically, you don't need to tell the width
  // if there's a parent

  public function		__construct($aWidth = 0)
  {
    $this->width = $aWidth;
  }

  // Main stuff is made here, returns a string representing
  // Widget's content. Kind of recursion.

  public function		render()
  {
    $result = array();
    $result[] = $this->renderLine($this->borders['top']);
    foreach ($this->children as $widget)
      {
	$widget_content = $widget->render();
	foreach ($widget_content as $widget_line)
	  {
	    $line = '';
	    $line .= $this->borders['left'];
	    $line .= $widget_line;
	    $line .= $this->borders['right'];
	    $result[] = $line;
	  }	
      }
    $result[] = $this->renderLine($this->borders['bottom']);

    return $result;
  }

  // Simply draws a line of the given pattern, okay okay okay I know could be optimized
  // because there are 2 strlens, AND SO WHAT?!

  public function		renderLine($aPattern)
  {
    $rendered_line = $this->borders['left'];
    for ($i = 0; ($i + strlen($aPattern)) <= $this->width; $i += strlen($aPattern))
      {
	$rendered_line .= $aPattern;
      }
    $rendered_line .= substr($aPattern, 0, $this->width - $i);
    $rendered_line .= $this->borders['right'];
    return $rendered_line;
  }

  // Settor for borders, assuming aBorder is an array containing strings
  // We also check if we are still inside our parent :)

  public function		setBorders($aBorder)
  {
    $old_width = strlen($this->borders['left']) + strlen($this->borders['right']);

    if (isset($aBorder['top'])) $this->borders['top'] = $aBorder['top'];
    if (isset($aBorder['left'])) $this->borders['left'] = $aBorder['left'];
    if (isset($aBorder['bottom'])) $this->borders['bottom'] = $aBorder['bottom'];
    if (isset($aBorder['right'])) $this->borders['right'] = $aBorder['right'];

    $new_width = strlen($this->borders['left']) + strlen($this->borders['right']);

    if ($this->parent !== false && $old_width < $new_width)
      {
	$new_width += $this->width;
	if ($this->parent->getWidth() - $new_width <= 0)
	  {
	    Common::FatalError('Widget::setBorders failed, can\'t create a so big widget: ' . $new_width);
	  }
      }
  }

  // Set the current instance to be the children of aParent
  // Let's say a children always occupy

  public function		setParent(VWidget $aParent)
  {
    $aParent->registerChildren($this);
    $this->parent = $aParent;
    $borderWidth = strlen($this->borders['left']) + strlen($this->borders['right']);
    $this->setWidth($aParent->getWidth() - $borderWidth);
  }

  // Creating a too small error is considered to be a fatal error
  // This is due to a programming mistake, or a too big descendance of children

  private function		setWidth($aWidth)
  {
    if ($aWidth <= 0)
      {
	Common::FatalError('Widget::setWidth failed, can\'t create a so small widget: ' . $aWidth);
      }
    $this->width = $aWidth;
  }

  // Simple accessor to return Widget's width, without including its borders size

  private function		getWidth()
  {
    return $this->width;
  }

  // Register a new children so as to be able to render it once
  // Rendering will consists of a display of each children

  private function		registerChildren($aChild)
  {
    if ($this->width == 0)
      {
	Common::FatalError('Widget::registerChildren failed, I\'m too little to register this children');
      }
    $this->children[] = $aChild;
  }

}
