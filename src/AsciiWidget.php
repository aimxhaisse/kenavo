<?php

require_once('src/Ascii.php');
require_once('src/AsciiBaseWidget.php');

// Base class for everything you want to display

abstract class			AsciiWidget extends AsciiBaseWidget
{
  abstract public function	render($aWidth);

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
    $parent = $aParent;
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

  // Returns an array representing each line
  // What we take as parameter is a pre-formatted array, we only need
  // to wrap it with padding, border, and margin
  //
  // This method assumes the array is already splitted and has a correct size
  // If it's not the case, lines may be truncated

  public function		renderContent($aArray)
  {
    $result = array();
    $content_width = $this->getWidth();

    foreach ($aArray as $line)
      {
	$formatted_line = '';

	$formatted_line .= Ascii::generatePattern(' ', $this->margins['left']);
	$formatted_line .= $this->border['left'];
	$formatted_line .= Ascii::generatePattern(' ', $this->paddings['left']);
	$formatted_line .= substr($line, 0, $content_width);
	$formatted_line .= Ascii::generatePattern(' ', $this->paddings['right']);
	$formatted_line .= $this->border['right'];
	$formatted_line .= Ascii::generatePattern(' ', $this->margins['right']);

	$result[] = $formatted_line;
      }

    return $result;
  }

}
