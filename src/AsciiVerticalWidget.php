<?php

require_once('src/Widget.php');

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

  // Let's construct that Widget with the following borders

  public function		__construct()
  {
    $this->borders = array('top'	=> '-',
			   'left'	=> '|',
			   'bottom'	=> '-',
			   'right'	=> '|');
  }

  // Main stuff is made here, returns a string representing
  // Widget's content. Kind of recursion.

  public function		render()
  {
    $result = array();
    $result[] = $this->renderLine('', $this->borders['top']);
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
    $result[] = $this->renderLine('', $this->borders['bottom']);

    return $result;
  }

}
