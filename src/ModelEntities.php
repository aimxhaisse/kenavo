<?php

require_once('src/ModelEntity.php');
require_once('src/Config.php');

// Here we provide functions to deal with group of entities
// Basically articles from a blog, images from a gallery, ...

class				Entities
{

  // Returns an associative array of the following pattern:
  // 
  // [Folder] = list of Entity instances
  // 
  // This can be usefull to retrieve a list of article from a category
  // assuming the category is the folder, and the article each file from it
  //
  // Example:
  // 
  // + articles
  //   + programming
  //     - Why VI Sucks!
  //     - SQL is for sissies!
  //   + life
  //     - About life and everything
  //     - Hello world
  // 
  // Will return the following:
  //
  // array(
  // "programming" => array(Article("Why VI Sucks!"),
  //			    Article("SQL is for sissies!")),
  // "life"	   => array(Article("About life and everything"),
  //			    Article("Hello world"))
  // )

  public static function	retrieveEntitiesByGroup($folder)
  {
    $result = array();
    if (($dh = opendir($folder)) !== false)
      {
	while (($item = readdir($dh)) !== false)
	  {
	    if ($item[0] !== '.')
	      {
		$result[$item] = self::retrieveEntities($folder . '/' . $item, basename($folder));
	      }
	  }
	closedir($dh);
      }
    return $result;
  }

  // Returns a list of entities from a folder

  public static function	retrieveEntities($folder)
  {
    $result = array();
    if (($dh = opendir($folder)) !== false)
      {
	while (($item = readdir($dh)) !== false)
	  {
	    if ($item[0] !== '.')
	      {
		$result[$item] = new Entity($folder . '/' . $item, basename($folder));
	      }
	  }
	closedir($dh);
      }
    return $result;
  }

  // Returns every grouped entities

  public static function	retrieveGroupedEntities($folder)
  {
    $result = array();
    if (($dh = opendir($folder)) !== false)
      {
	while (($item = readdir($dh)) !== false)
	  {
	    if ($item[0] !== '.')
	      {
		$result = array_merge($result, self::retrieveEntities($folder . '/' . $item));
	      }
	  }
	closedir($dh);
      }
    return $result;
  }

}
