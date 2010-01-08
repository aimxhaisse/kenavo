<?php

// This class stores permanent data from an article in a hidden
// file, so as to be accessible even if the file system changes

class				ModelEntityHeader
{
  private			$author;
  private			$creation_date;

  public function		setAuthor($aAuthor)
  {
    $this->author = $aAuthor;
  }

  public function		setCreationDate($aCreationDate)
  {
    $this->creation_date = $aCreationDate;
  }

  public function		getAuthor()
  {
    return $this->author;
  }

  public function		getCreationDate()
  {
    return $this->creation_date;
  }

}
