<?php

// All of the code for the Page not found page is found here.
class PageNotFoundController extends PageController {

  // This class only runs when the user tries to go to a page that doesn't exist.
  // Basically there isn't any functionality here, and there isn't even a constructor!
  // This file is the definition of boring.

  public function buildHTML() {

    echo $this->plates->render('page-not-found');

  }


}













//
