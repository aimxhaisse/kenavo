<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title><?php echo TITLE ?></tile>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="jquery-1.3.2.min.js"></script>
    <script src="script.js"></script>
  </head>
  <body>
   <div id="corpus">
     <div id="menu">
       |
       <?php foreach ($menu_pages as $page => $link): ?>
       <a href="index.php?page=<?php echo $link ?>"><?php echo $page ?></a> |
       <?php endforeach ?>
     </div>

<!-- ASCII CONTENT -->
<pre id="content">
<?php echo $app ?></pre>
<!-- /ASCII CONTENT -->

<div id="sidebar">

  <!-- SEARCH -->

  <form id="search" name="search" action="?page=search" method="post">
    <input id="search_input" type="text" name="pattern" />    
  </form>

   <?php include('src/SideCategories.php'); ?>

</div>

     <pre id="footer">page generated in <?php echo microtime() - $time ?> seconds</pre>
   </div>
  </body>
</html>
