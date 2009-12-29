<?php

// Here we can peacely define some functions that will be used everywhere

// Okay something bad went wrong, let's stop the fan before shit arrives in it
// Prints a diagnostic (or not) before dying

function		fatal_error($aMessage = false)
{
  if ($aMessage !== false && true === DEVEL)
    {
      printf("Fatal error: %s\n", $aMessage);
      die();
    }
  printf("Ooops, something went wrong :( Feel free to wake up %s\n", ADMIN);
  die();
}
