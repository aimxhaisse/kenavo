<?php

// ==================================================
// Feel free to change the following settings:
// ==================================================

// -- enable/disable debugs
define('DEVEL', true);

// -- folder where articles are stored
define('ARTICLES', 'data/articles');


// ==================================================
// INTERNALS!
// Do not touch without knowing what you do
// ==================================================

error_reporting(DEVEL ? E_ALL : E_NONE);
