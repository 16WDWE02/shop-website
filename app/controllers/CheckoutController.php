<?php

// This controller is in charge of the Checkout page.
// We would want the user to confirm the postal address and maybe get some billing info here too
// This project will not handle the actual payment of the products, BUT we can update the database with an order
class CheckoutController extends PageController {

  // CONSTRUCTOR! This runs IMMEDIATELY when index.php says new CartController();
  public function __construct() {

    // Let's make sure the PageController constructor still runs:
    parent::__construct();

  }

  // We MUST include this function as defined in PageController
  public function buildHTML() {

    echo $this->plates->render('checkout', $this->data);

  }

}
