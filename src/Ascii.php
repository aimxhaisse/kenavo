<?php

// Procedural tools that doesn't require any instance

class				Ascii
{

  // Generates a string composed of N times $aPattern + a random number of
  // characteres from $aPattern so that strlen($result) == $aSize

  public static function	generatePattern($aPattern, $aSize)
  {
    $len = strlen($aPattern);
    $result = '';
    for ($i = 0; ($i + $len) < $aSize; $i += $len)
      {
	$result .= $aPattern;
      }
    $result .= substr($aPattern, 0, $aSize - $i);
    return $result;
  }

  // Returns the length of a string stripping html tags

  public static function	getStrippedSize($content)
  {
    $matches = array();
    preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)*/", 
		   $content, $matches, PREG_SET_ORDER);
    $result = 0;
    foreach ($matches as $raw_content)
      {
	if (isset($matches[2]))
	  {
	    $result += strlen($matches[2]);
	  }
      }
    return $result;
  }

}
