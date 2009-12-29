<?php

class				Dispatcher
{

  // Includes the appropriated controller according to the request

  public static function	dispatch()
  {
    $rules = parse_ini_file(ROUTING, true) or Common::fatalError('unable to open routing ini file.');
    
    foreach ($rules as $name => $route)
      {
	if (Holder::get('page') === $name)
	  {
	    require_once($route['controller']);
	    return true;
	  }
      }

    require_once(Holder::get('page'));

    return false;
  }

}
