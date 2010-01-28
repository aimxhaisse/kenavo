<?php

require_once('src/ModelEntityHeader.php');

// Bored of SQL? Let's store everything using filesystem !
//
// Why?
//
// - Less painfull to edit than web-bases inputs
// - Everything you need is already there :
//      * Date of creation
//      * Author
//      * Content of different type (image, content, ...)
//      * Relationships ? Mouahaha... man ln
// - Don't care of performances in a blog?
// - <troll>

class			Entity
{
  private		$content;
  private		$title;
  private		$path;
  private		$category;
  private		$cache;
  private		$token;

  public function	__construct($aPath, $aCategory)
  {
    $this->category = $aCategory;
    $this->path = $aPath;
    $this->cache = false;
    $this->content = false;
    $this->title = false;
    $this->token = md5($aPath . $aCategory);
    $this->initialize();
  }

  public function	getToken()
  {
    return $this->token;
  }

  public function	getCategory()
  {
    return $this->category;
  }

  public function	getTitle()
  {
    return basename($this->path);
  }

  public function	getDate()
  {
    return date("F d Y H:i:s", $this->cache->getCreationDate());
  }

  public function	getTimestamp()
  {
    return $this->cache->getCreationDate();
  }

  public function	getPath()
  {
    return $this->path;
  }

  public function	getAuthor()
  {
    return $this->cache->getAuthor();
  }

  public function	getContent()
  {
    if ($this->content === false)
      {
	$this->initContent();
      }
    return $this->content;
  }

  // Generates a "cache" file in it doesn't exists
  // (that means the entity was just created) so as to keep some informations
  // persistant.
  // If it already exists, simply uses its informations.

  private function	initialize()
  {
    $cache_path = $this->path . ".cache";

    if (!file_exists($cache_path))
      {

	$obj = new ModelEntityHeader();

	$date = filemtime($this->path);
	$owner = posix_getpwuid(fileowner($this->path));

	$obj->setCreationDate($date);
	$obj->setAuthor($owner['name']);

	file_put_contents($cache_path, serialize($obj));

	$this->cache = $obj;
      }
    else
      {
	$this->cache = unserialize(file_get_contents($cache_path));
      }
  }

  // Generates file's content to be rendered
  // At that moment, simply returns its content, next step
  // is to generate ascii from images, ...

  private function	initContent()
  {
    $this->content = file_get_contents($this->path);
  }

}

// </troll>
