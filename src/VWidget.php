<?php

require_once('Common.php');
require_once('Widget.php');

// V is for Vertical Widget !
// Simply change the way we render

class				VWidget extends Widget
{

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

}
