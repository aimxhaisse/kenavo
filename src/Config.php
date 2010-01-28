<?php

// ==================================================
// Feel free to change the following settings:
// ==================================================

// -- enable/disable debugs
define('DEVEL', true);

// -- admin to contact
define('ADMIN', 'rannou.sebastien@gmail.com');

// -- folder where articles are stored
define('ARTICLES', 'data/articles');

// -- ini file which stores routing rules
define('ROUTING', 'routing.ini');

// -- width of the template (in characteres)
define('WIDTH', 240);

// -- title of the page
define('TITLE', "Yet Another Dev Blog :-)");

// -- directory where to store serialized content
define('SERIALIZED', 'data/serialized');

// -- contains serialized pages
define('SERIALIZED_ROUTES', SERIALIZED . '/pages');

// -- menu pages
$menu_pages = array('blog'	=> 'home',
		    'about'	=> 'about',
		    'projects'	=> 'projects');

// ==================================================
// INTERNALS!
// Do not touch without knowing what you do
// ==================================================

error_reporting(DEVEL ? E_ALL : E_NONE);
