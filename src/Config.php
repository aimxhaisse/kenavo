<?php

// ==================================================
// Feel free to change the following settings:
// ==================================================

// -- enable/disable debugs
define('DEVEL', true);

// -- root
define('ROOT_URI', 'http://mxs.buffout.com/');

// -- admin to contact
define('ADMIN', 'rannou.sebastien@gmail.com');

// -- folder where articles are stored
define('ARTICLES', 'data/articles');

// -- file where is stored about page
define('PAGE_ABOUT', 'data/about');

// -- ini file which stores routing rules
define('ROUTING', 'routing.ini');

// -- width of the template (in characteres)
define('WIDTH', 240);

// -- title of the page
define('TITLE', "There is no spoon...");

// -- directory where to store serialized content
define('SERIALIZED', 'data/serialized');

// -- contains serialized pages
define('SERIALIZED_ROUTES', SERIALIZED . '/pages');

// -- some stats
define('STATS', SERIALIZED . '/stats');

// -- menu pages
$menu_pages = array('blog'	=> 'home',
		    'about'	=> 'about');

// ==================================================
// INTERNALS!
// Do not touch without knowing what you do
// ==================================================

error_reporting(DEVEL ? E_ALL : E_NONE);
