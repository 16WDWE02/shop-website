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

    // Pagination allows us to show X amounts of products at a time.
    // We need to figure out a few things first, like how many pages of products there are and if the user is viewing one now.

    // Has the user requested a paticular page of products?
    if( isset($_GET['pagination']) ) {
      // They have! OK, we need to use this number (it better be a number) to load some products
      $paginationPage = $this->dbc->real_escape_string($_GET['pagination']);
    } else {
      // No? That's fine. We'll show them the first page.
      $paginationPage = 1;
    }

    // How many products are there? We need this to calculate how many PAGES there are.
    $sql = "SELECT COUNT(id) AS TotalProducts FROM products";
    $result = $this->dbc->query($sql);
    $result = $result->fetch_assoc();

    // Cool, now we just need that number which tells us how many products there are.
    $totalProducts = $result['TotalProducts'];

    // Let's calculate how many pages there will be
    // The 10 means 10 products per page
    $totalPages = $totalProducts / 10;
    // The problem here is that if we had 12 products at 10 per page, the total pages will be 1.2.
    // Have you ever seen a fifth of a page? No. Let's round it.
    $totalPages = ceil($totalPages);
    // ceil means ceiling, or up. So, round up.
    // floor means... floor. As in down. So, round down.
    // Now $totalPages should be a whole number that is suitable for the amount of products we have.
    // Instead of 1.2 pages, we have 2.
    // The template needs to know about this to create a list of page options
    $this->data['totalPages'] = $totalPages;
    // Done.

    // Here's the confusing part:
    // If the user requested page 1, we need an offset of 0
    // If the user requested page 2, we need an offset of 10.
    // I suppose we could multiply the page number by the offset, and substract 10?
    $offset = $paginationPage * 10 - 10;

    // Prepare the query
    $sql = "SELECT * FROM products LIMIT 10 OFFSET $offset";

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
