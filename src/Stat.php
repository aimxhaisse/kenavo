<?php

class Stat
{
  // Very simple logger, to be upgraded...

  // Loads the database from the Stat file
  public static function	loadDb()
  {
    if (!file_exists(STATS))
      {
	return array();
      }
    return unserialize(file_get_contents(STATS));
  }

  // Save the database to the Stat file
  private static function	saveDb($db)
  {
    file_put_contents(STATS, serialize($db));
  }

  // Let's log the request
  public static function	log()
  {
    $db = self::loadDb();
    if (!isset($db['total_pages']))
      {
	$db['total_pages'] = 0;
      }
    $db['total_pages']++;
    self::saveDb($db);
  }

}
