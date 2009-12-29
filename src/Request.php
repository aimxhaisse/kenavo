<?php

// This page stores the content of the query, performing (or not)
// security checks or protections

class				RequestHolder
{
  private static		$get_holder;

  // initialize the RequestHolder

  public static function	init()
  {
    global			$_GET;

    foreach ($_GET as $key => $value)
      {
	self::$get_holder[$key] = $value;
      }
  }

  // boom boom pow gotta get get

  public static function	getGet($aKey)
  {
    if (isset(self::$get_holder[$aKey]) === true)
      {
	return self::$get_holder[$aKey];
      }
    fatal_error("RequestHolder::getGet: unknown key -> " . $aKey);
  }

}
