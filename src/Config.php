<?php

// ==================================================
// Feel free to change the following settings:
// ==================================================

// -- enable/disable debugs
define('DEVEL', true);

// -- Admin to contact
define('ADMIN', 'rannou.sebastien@gmail.com');

// -- folder where articles are stored
define('ARTICLES', 'data/articles');

// -- ini file which stores routing rules
define('ROUTING', 'data/routing.ini');

// ==================================================
// INTERNALS!
// Do not touch without knowing what you do
// ==================================================

error_reporting(DEVEL ? E_ALL : E_NONE);
