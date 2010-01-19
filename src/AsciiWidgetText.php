<?php

require_once('src/AsciiWidget.php');
require_once('src/Ascii.php');

// Base class for TextWidgets
// Includes BBCODE so as to have a standart way to write everything without
// breaking ascii rules (so easy to have something larger than one charactere in html :P)

class			AsciiWidgetText extends AsciiWidget
{
  private		$text;
  private		$uppercase = false;
  private		$bbcode;

  public function	__construct(AsciiBaseWidget $parent)
  {
    $bb = array(
		// Root node
		''		=> array('type'			=> BBCODE_TYPE_ROOT),
		
		// Code
		'code'		=> array('type'			=> BBCODE_TYPE_NOARG,
					 'open_tag'		=> '<span class="code">',
					 'close_tag'		=> '</span>'),

		// Bold
		'b'		=> array('type'			=> BBCODE_TYPE_NOARG,
					 'open_tag'		=> '<b>',
					 'close_tag'		=> '</b>'),

		// Italic
		'i'		=> array('type'			=> BBCODE_TYPE_NOARG,
					 'open_tag'		=> '<i>',
					 'close_tag'		=> '</i>'),


		// Url
		'url'		=> array('type'			=> BBCODE_TYPE_OPTARG,
					 'open_tag'		=> '<a href="{PARAM}">',
					 'close_tag'		=> '</a>'),

		// Colors
		'color'		=> array('type'			=> BBCODE_TYPE_OPTARG,
					 'open_tag'		=> '<span style="color:{PARAM};">',
					 'close_tag'		=> '</span>'),

		// Img
		'img'		=> array('type'			=> BBCODE_TYPE_OPTARG,
					 'open_tag'		=> '<img class="floating_image" src="{PARAM}">',
					 'close_tag'		=> '</img>'),
		

		// Cursor
		'cursor'	=> array('type'			=> BBCODE_TYPE_NOARG,
					 'open_tag'		=> '<span class="blinking">',
					 'close_tag'		=> '</span>')

		);

    $this->bbcode = bbcode_create($bb);

    parent::__construct($parent);
  }

  public function	__destruct()
  {
    if ($this->bbcode)
      {
	bbcode_destroy($this->bbcode);
      }
  }

  public function	setText($aText)
  {
    $this->text .= bbcode_parse($this->bbcode, $aText);
  }

  public function	setUpperCase()
  {
    $this->uppercase = true;
  }

  public function	render()
  {
    $result = array();
    $lines = explode("\n", $this->text);
    $width = $this->getWidth();

    foreach ($lines as $line)
      {
	if ($this->uppercase)
	  {
	    $line = strtoupper($line);
	  }
	$result[] = $line;
      }

    return parent::renderContent($result);
  }
}
