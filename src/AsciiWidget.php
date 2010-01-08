<?php

require_once('src/Ascii.php');
require_once('src/AsciiBaseWidget.php');

// Base class for everything you want to display

abstract class			AsciiWidget extends AsciiBaseWidget
{
  abstract public function	render();

  protected			$borders = array('top'		=> '',	// bottom = top = '-', left = right = '|' will give:
						 'left'		=> '',  // ------------------
						 'right'	=> '',  // |Widget's content|
						 'bottom'	=> ''); // ------------------

  protected			$margins = array('top'		=> 0,	// bottom = top = 0, left = 5, right = 0 will give:
						 'left'		=> 0,   //      ------------------
						 'right'	=> 0,   //      |Widget's content|
						 'bottom'	=> 0);  //      ------------------

  protected			$paddings = array('top'		=> 0,	// bottom = top = 0, left = 1, right = 3 will give:
						  'left'	=> 0,   // -----------------
						  'right'	=> 0,   // | Widget's co   |
						  'bottom'	=> 0);  // -----------------

  private			$parent;				// Widgets always have one parent (AsciiWidget or AsciiMasterWidget)

  // Constructor, you can't construct an AsciiWidget without a parent
  // which can either a AsciiWidget subclass or a AsciiMasterWidget

  public function		__construct(AsciiBaseWidget $aParent)
  {
    $this->parent = $aParent;
  }

  // Returns internal width of the widget (what it can actually contain)
  // Example:
  //
  // Current widget has: left/right padding of 1
  //			 left/right margin of 1
  //  
  //  -------------
  //  |           |
  //  | {content} |
  //  |           |
  //  -------------
  //
  // getWidth() will return the width the content can feet in

  public function		getWidth()
  {
    $parentWidth = $this->parent->getWidth();

    $addedWidth = 0;
    $addedWidth += strlen($this->borders['left']);
    $addedWidth += strlen($this->borders['right']);
    $addedWidth += $this->margins['left'];
    $addedWidth += $this->margins['right'];
    $addedWidth += $this->paddings['left'];
    $addedWidth += $this->paddings['right'];

    return $parentWidth - $addedWidth;
  }

  public function		setBorders($array)
  {
    $this->borders = array_merge($this->borders, $array);
  }

  // Let's render a $line

  private function		renderLine($content, $content_width)
  {
    $left = '';
    $right = '';
    $middle = '';
    
    $left .= Ascii::generatePattern(' ', $this->margins['left']);
    $left .= $this->borders['left'];
    $left .= Ascii::generatePattern(' ', $this->paddings['left']);

    $right .= Ascii::generatePattern(' ', $this->paddings['right']);
    $right .= $this->borders['right'];
    $right .= Ascii::generatePattern(' ', $this->margins['right']);

    $middle .= substr($content, 0, $content_width);
    $middle .= Ascii::generatePattern(' ', $content_width - (strlen($middle)));

    return $left . $middle . $right;
  }

  public function		drawBorder($aPattern, $parent_width)
  {
    $left = '';
    $right = '';
    $middle = '';
    
    $left .= Ascii::generatePattern(' ', $this->margins['left']);
    $left .= $this->borders['left'];

    $right .= $this->borders['right'];
    $right .= Ascii::generatePattern(' ', $this->margins['right']);

    $middle .= Ascii::generatePattern($aPattern, $parent_width - strlen($right) - strlen($left));

    return $left . $middle . $right;
  }

  // Returns an array representing each line
  // What we take as parameter is a pre-formatted array, we only need
  // to wrap it with padding, border, and margin
  //
  // This method assumes the array is already splitted and has a correct size
  // If it's not the case, lines may be truncated

  public function		renderContent($aArray)
  {
    $result = array();
    $parent_width = $this->parent->getWidth();
    $content_width = $this->getWidth();

    // Top
    for ($i = 0; $i < $this->margins['top']; ++$i)	$result[] = Ascii::generatePattern(' ', $parent_width);
    if (strlen($this->borders['top']))			$result[] = $this->drawBorder($this->borders['top'], $parent_width);
    for ($i = 0; $i < $this->paddings['top']; ++$i)	$result[] = $this->renderLine("", $content_width);

    // Content
    foreach ($aArray as $line)
      {
	$result[] = $this->renderLine($line, $content_width);
      }

    // Bottom
    for ($i = 0; $i < $this->paddings['bottom']; ++$i)		$result[] = $this->renderLine("", $content_width);
    if (strlen($this->borders['bottom']))			$result[] = $this->drawBorder($this->borders['bottom'], $parent_width);
    for ($i = 0; $i < $this->margins['bottom']; ++$i)		$result[] = Ascii::generatePattern(' ', $parent_width);

    return $result;
  }

}