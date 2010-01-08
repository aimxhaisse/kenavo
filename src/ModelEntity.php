<?php

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
  private		$author;
  private		$date;
  private		$path;
  private		$category;

  public function	__construct($aPath, $aCategory)
  {
    $this->path = $aPath;
    $this->content = false;
    $this->title = false;
    $this->author = false;
    $this->date = false;
    $this->category = $aCategory;
  }

  public function	getCategory()
  {
    return $this->category;
  }

  // No need to cache this as this is not heavy

  public function	getTitle()
  {
    return basename($this->path);
  }

  // Cached accessor

  public function	getDate()
  {
    if ($this->date === false)
      {
	$this->initDate();
      }
    return $this->date;
  }

  public function	getPath()
  {
    return $this->path;
  }

  // Cached accessor

  public function	getAuthor()
  {
    if ($this->author === false)
      {
	$this->initAuthor();
      }
    return $this->author;
  }

  // Cached accessor

  public function	getContent()
  {
    if ($this->content === false)
      {
	$this->initContent();
      }
    return $this->content;
  }

  // Assuming the author is the owner of the file

  public function	initAuthor()
  {
    $array = posix_getpwuid(fileowner($this->path));
    if (isset($array['name']))
      {
	$this->author = $array['name'];
      }
    else
      {
	$this->author = "Unknown";
      }
  }

  // Generates a string of the date in the following fmt:
  // December 30 2009 22:16:24

  private function	initDate()
  {
    $this->date = date("F d Y H:i:s", filemtime($this->path));
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
