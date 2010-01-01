<?php

require_once('src/AsciiBaseWidget.php');

// Simply contains a list of sub widgets that need to be rendered
// At that moment, this class doesn't add any graphic stuff
//
// This can be seen as a QtWidget without parent, but to keep
// the code simple, let's separate this two different things.

class				MasterWidget extends AsciiBaseWidget
{
  private			$width;
  private			$children = array();

  // The only thing that's required here is a width (in characteres)
  // Height will depend of the size of children

  public function		__construct($aWidth)
  {
    $this->width = $aWidth;
  }

  // Returns a string of what we need to render

  public function		__toString()
  {
    $result = '';
    foreach ($this->children as $child)
      {
	$result .= $child->render($this->width);
      }
    return $result;
  }

  // Returns current width

  public function		getWidth()
  {
    return $this->width;
  }

  // Let's register a new children

  public function		registerChildren(Widget & $aChild)
  {
    $this->children[] = $aChild;
  }

}
