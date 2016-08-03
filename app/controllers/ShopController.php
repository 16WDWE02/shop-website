<?php

// This controller is in charge of the Shop page.
class ShopController extends PageController {

  // CONSTRUCTOR! This runs IMMEDIATELY when index.php says new CartController();
  public function __construct() {

    // Let's make sure the PageController constructor still runs:
    parent::__construct();

    // This is the shop page! We need to show some products, right?
    // This is pre-pagination
    $this->getAllProducts();

  }

  // We MUST include this function as defined in PageController
  public function buildHTML() {

    echo $this->plates->render('shop', $this->data);

  }

  // This function is specific to this page, so no need for it to be public
  private function getAllProducts() {

    // Prepare the query
    $sql = "SELECT * FROM products";

    // Run the query
    $result = $this->dbc->query($sql);

    // There's no way the query could have failed since it doesn't have user input
    // BUT, the database could have changed so we should probably check anyway
    if( !$result ) {
      die('This is bad. We cannot get any products from the database. Admin, this should not happen!');
    }

    // OK, so the query worked. At this point $result is a Database Object with either 0, 1 or many results.
    // Let's extract whatever is inside and store it for Later
    $this->data['allProducts'] = $result->fetch_all(MYSQLI_ASSOC);
    // If there are no products then we'll have to tell the user in the template file

  }

}
