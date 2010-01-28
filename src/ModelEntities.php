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
  // "programming" => array(Entity("Why VI Sucks!"),
  //			    Entity("SQL is for sissies!")),
  // "life"	   => array(Entity("About life and everything"),
  //			    Entity("Hello world"))
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
    uasort($result, 'cmpEntities');
    return $result;
  }

  // Returns a list of entities from a folder

  public static function	retrieveEntities($folder, $limit = false)
  {
    $result = array();

    if (($dh = opendir($folder)) !== false)
      {
	while (($item = readdir($dh)) !== false)
	  {
	    if ($item[0] !== '.')
	      {
		if (is_dir($folder . '/' . $item))
		  {
		    $result = array_merge(self::retrieveEntities($folder . '/' . $item, $limit), $result);
		  }
		else if (!preg_match("/\.cache$/", $item))
		  {
		    $result[$item] = new Entity($folder . '/' . $item, basename($folder));
		  }
		if (false !== $limit && count($result) >= $limit)
		  {
		    $result = array_slice($result, 0, $limit);
		    break;
		  }
	      }
	  }
	closedir($dh);
      }
    uasort($result, 'cmpEntities');
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
    uasort($result, 'cmpEntities');
    return $result;
  }

  // Returns an Entity from its token
  // If not yet serialized, look for the given token and add it into
  // serialized page

  public static function	retrieveEntity($token)
  {
    $existing_pages = unserialize(file_get_contents(SERIALIZED_ROUTES));
    if (!isset($existing_pages[$token]))
      {
	$articles = self::retrieveGroupedEntities(ARTICLES);
	foreach ($articles as $article)
	  {
	    if (!isset($existing_pages[$article->getToken()]))
	      {
		$existing_pages[$article->getToken()] = array('category' => $article->getCategory(),
							      'path'	 => $article->getPath());

		// We don't immediately return the matching article so as to
		// refresh the hole articles, as we already have fetched them
	      }
	  }
	file_put_contents(SERIALIZED_ROUTES, serialize($existing_pages));
      }
    
    if (isset($existing_pages[$token]))
      {
	return new Entity($existing_pages[$token]['path'], $existing_pages[$token]['category']);
      }
    return false;
  }

  // Returns an array of available categories

  public static function	retrieveCategories()
  {
    $result = array();

    if (($dir = opendir(ARTICLES)) !== false)
      {
	while (($item = readdir($dir)) !== false)
	  {
	    if ($item != "." && $item != ".." && is_dir(ARTICLES . '/' . $item))
	      {
		$result[] = $item;
	      }
	  }
	closedir($dir);
      }
    return $result;
  }
  
}

function	cmpEntities($a, $b)
{
  return $a->getTimestamp() < $b->getTimestamp();
}
