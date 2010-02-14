<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title><?php echo TITLE ?></title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel='index' title='there is no spoon' href='http://www.aimxhaisse.com' />

    <meta name="keywords" content="programming development blog ascii-art hacking" />
    <meta name="description" content="yet another developer blog" />
    <meta name="author" content="sebastien rannou" />

    <script src="jquery-1.3.2.min.js"></script>
    <script src="script.js"></script>

  </head>
  <body>
    <div id="corpus">

      <div id="menu">
	<?php foreach ($menu_pages as $page => $link): ?>
	<a href="index.php?page=<?php echo $link ?>"><?php echo $page ?></a>
	<?php endforeach ?>
      </div>

      <!-- ASCII CONTENT (yaw this is ugly) -->
      <pre id="content"><?php echo $app ?></pre>
      <!-- /ASCII CONTENT -->

      <div id="sidebar">

	<!-- ICONS -->
	<a href="index.php?page=rss"><img src="img/rss-32x32.png" alt="rss feed" /></a>
	<a href="http://twitter.com/aimxhaisse"><img src="img/twitter-32x32.png" alt="twitter" /></a>
	<a href="http://www.google.com/reader/shared/04605112158610849041"><img src="img/google-32x32.png" alt="google reader" /></a>
	<br /><br />
	<!-- /ICONS -->

	<!-- SEARCH -->
	<form id="search" name="search" action="?page=search" method="post">
	  <input id="search_input" type="text" name="pattern" value="search" />    
	</form>
	<!-- /SEARCH -->

	<?php include('src/SideCategories.php'); ?>

	<!-- PALS -->
	<h2>/links</h2>
	<!-- 
	<h3><a href="http://lioks.buffout.com">lioks</a></h3>
	<h3><a href="http://gagaro.buffout.com">gagaro</a></h3>
	<h3><a href="http://guns.buffout.com">guns</a></h3>
	-->
	<h3><a href="http://aimxhaisse.com/old_blog">old blog</a></h3>
	<h3><a href="http://faltad.buffout.com">faltad</a></h3>
	<!-- /PALS -->

      </div>

      <pre id="footer">page generated in <?php echo microtime() - $time ?> seconds</pre>

    </div>
  </body>
</html>
