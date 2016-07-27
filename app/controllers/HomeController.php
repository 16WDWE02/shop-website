<?php

// All of the code for the home page is found here.
// Any PUBLIC or PROTECTED properties / methods in the PageController are
// accessible HERE in the HomeController. These two files collaborate.
class HomeController extends PageController {

  // CONSTRUCTOR! This runs IMMEDIATELY when index.php says new HomeController();
  public function __construct() {

    // But wait! HomeController extends PageController and INHERITS public and
    // protected properties and methods, and the PageController has a __construct too.
    // CONFLICT! WHICH ONE DO WE USE??!!
    // THIS constructor is going to override the PageController constructor and none
    // of the code in the PageController's constructor will run! But we need it to, because
    // it creates an instance of the Plates library! WE REALLY DO NEED THAT!
    // Let's make sure the PageController constructor still runs:
    parent::__construct();

    // Let's get the 10 latest products from the database.
    // This is going to require a query, processing, validation etc.
    // We don't want to clutter this constructor with all that code, so we'll
    // create a function for it. Functions should perform one job.
    $this->getTheTenLatestProducts();
    // You'll need to find this function in here somewhere, and then once it's done you
    // come back to this line and carry on reading down.


  }


  // Here's the function that gets the ten latest products.
  // It's private because there's no reason (at the moment) for any other code outside this class
  // to have access to this function. Set stuff to private unless you know they NEED to be public.
  private function getTheTenLatestProducts() {

    // We need to prepare a query for the database
    // We probably only need the NAME, PRICE and IMAGE of the product. (No images in this example, sorry)
    // These are mainly previews of the latest products, so we don't need to overwhelm the visitor with
    // too much info. If they're interested, they can click the image for more info.
    // AH! If the user is going to click the product, we'll need to know the ID of the product too!
    $sql = "SELECT id, name, price, date_added
            FROM products
            ORDER BY date_added DESC
            LIMIT 10";

    // Now that the query is prepared, we can run it and hope for the best!
    // Since this is a SELECT query (The READ in CRUD), we need to capture the result for use later on
    $result = $this->dbc->query( $sql );

    // It's a good idea to CHECK IF THE QUERY WORKED, because who knows, what if it didn't?
    // What'll happen to the site?
    // There are three possible outcomes here:

    // 1. Did the query HIDEOUSLY FAIL?
    if( !$result ) {

      // Oh dear... Something must be wrong with the query, or maybe the database has changed?
      // Is the database gone? Has the table been renamed, or is it called picture instead of image?
      // This is bad...
      // What on earth do we do now?
      // This is a pretty important part of the site, so maybe the admin should be contacted.
      // We'd need some kind of E-Mail system for that.
      die("Can't get the latest products from the database. This isn't supposed to happen. We need a better error system than this...");

    }

    // 2. Did the query work but nothing came back from the database?
    elseif( $result->num_rows == 0 ) {

      // Well that's weird.
      // This would only happen if there aren't any products in the database.
      // This might be true for a small home based business, but not large scale shops.
      // We would probably show "No products", or something like that.
      // Later on the template files are going to be expecting some products,
      // so we either die here or send them a blank array to loop over.
      // We'll have to make that code in the template say "No products",
      // so we'll deal with that later. For now, let's save a blank array as our products.
      // This is much better than having nothing at all.
      $this->data['theTenLatestProducts'] = [];
      // The "$this->data" property is in the PageController, and it's immediately established as an array,
      // so all you have to do is point to it, create a key and store something into that key.
      // When the template files recieve the data, these keys are turned into variables. (That's how Plates does it)
      // So make sure the keys are appropriate. You can't say "the-ten-latest-products", because "$the-ten-latest-products" won't work as a variable.

    }

    // 3. IT WORKED!
    elseif( $result->num_rows > 0 ) {

      // YES! Ahem, I mean, of course it did...
      // Notice how the elseif says > 0. Sure we are trying to get the 10 latest products,
      // but that doesn't mean there are actually at least TEN products in the database,
      // so let's accomodate for those days when we only have like 3 products for sale.

      // At this point the "$result" is a Database Object. It's full of methods and properties (like num_rows),
      // but we don't care about that any more. We need the data!
      // Let's extract the data (as an associative array) and store it in the "$this->data" property for later.
      $this->data['theTenLatestProducts'] = $result->fetch_all( MYSQLI_ASSOC );
      // That MYSQLI_ASSOC is important. The fetch_all function will grab multiple records (rows returned from the database),
      // at a time, BUT it will store them as a NUMERICAL ARRAY BY DEFAULT. Numerical arrays (depending on context) are difficult to work with.
      // MYSQLI_ASSOC makes sure we get them as associative arrays instead.

      // For example:
      // $numericArrayExample = [
      //   0 => 'Abbott',
      //   1 => 'Ben',
      //   2 => 'Wellington'
      // ];
      // Which one is the first name? Well that would be "$numericArrayExample[1];"
      // But that looks terrible. Associative arrays as SO MUCH NICER!
      // $associativeArrayExample = [
      //   'LastName' => 'Abbott',
      //   'FirstName' => 'Ben',
      //   'Location' => 'Wellington'
      // ];
      // That would be "$associativeArrayExample['LastName'];"
      // Much better.

    }



  }

  // BUILD HTML!
  // This function is found in every individual page controller, BUT it's one of the last functions to run!
  // That's because by this point, all of the necessary page data has been obtained, forms have been processed and there
  // is literally only one more thing to do, and that's to send the user some delicious HTML!
  public function buildHTML() {

    // Keep in mind, this function is called from index.php as the last thing in that file, AND
    // this is a function that MUST be included every individual page controller. The PageController says so.

    // Fortunately all the hard work is done and dusted, now we just need to load the right set of HTML templates
    // and send them all the data to present to the user!
    // Don't forget to echo (send to the browser) the result of our HTML building!
    echo $this->plates->render('home', $this->data);
    // REMEMBER, $this->data is an array that has keys in it like "theTenLatestProducts" which will be used as variables
    // in the template files.
    // You can always print_r($this->data) to see what's being sent to the templates.

  }


}













//
