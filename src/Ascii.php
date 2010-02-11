<?php

// Procedural tools that doesn't require any instance

$bb_code = false;

class				Ascii
{

  // Generates a string composed of N times $aPattern + a random number of
  // characteres from $aPattern so that strlen($result) == $aSize

  public static function	generatePattern($aPattern, $aSize)
  {
    $len = self::getStrippedSize($aPattern);
    $result = '';
    for ($i = 0; ($i + $len) <= $aSize; $i += $len)
      {
	$result .= $aPattern;
      }
    return $result;
  }

  // Returns the length of a string stripping html tags

  public static function	getStrippedSize($content)
  {
    return strlen(strip_tags($content));
  }

  // Initialize BBCODE

  private static function	initialize(&$bb_code)
  {
    $bb = array(
		// Root node
		''		=> array('type'				=> BBCODE_TYPE_ROOT),
		
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

    $bb_code = bbcode_create($bb);
  }

  // Generates a html rendering of a bbcode string

  public static function	generateHTML($str)
  {
    global $bb_code;
    
    if ($bb_code === false)
      {
	self::initialize($bb_code);
      }
    return bbcode_parse($bb_code, $str);
  }

}
