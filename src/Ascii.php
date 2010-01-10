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
    return strlen(strip_tags($content));
  }

}
