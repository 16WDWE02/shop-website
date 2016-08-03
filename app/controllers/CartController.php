<?php

// This controller is in charge of the Cart page. Not the cart itself.
// This page will show the user their cart contents and give them the ability to update (add/remove)
// items from their cart
class CartController extends PageController {

  // CONSTRUCTOR! This runs IMMEDIATELY when index.php says new CartController();
  public function __construct() {

    // Let's make sure the PageController constructor still runs:
    parent::__construct();

  }

  // We MUST include this function as defined in PageController
  public function buildHTML() {

    echo $this->plates->render('cart', $this->data);

  }

}
