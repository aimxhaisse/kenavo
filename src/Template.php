<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title><?php echo TITLE ?></tile>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
   <div id="corpus">
     <div id="menu">
       <?php foreach ($menu_pages as $page => $link): ?>
       <a href="index.php?page=<?php echo $link ?>">
	 <?php echo $page ?>
       </a>
       <?php endforeach ?>
     </div>

<!-- ASCII -->
<pre id="content">
<?php echo $app ?></pre>
<!-- /ASCII -->

     <pre id="footer">page generated in <?php echo microtime() - $time ?> seconds</pre>
   </div>
  </body>
</html>
