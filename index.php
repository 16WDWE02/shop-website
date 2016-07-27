<?php

// -------------- READ ME -------------- //
// Shopping cart website.

// Not all websites require you to be logged in to have a cart.

// The problem here is that we can't have a database for cart contents
// because how do we associate a cart to an unknown user?

// This website will be using a session to store the cart.
// The benefit of this is that the visitor doesn't need an account,
// but the downside is that they only have this cart on one device.
// If the user jumps onto a new device, the session doesn't follow
// therefore their cart will be empty on the new device.

// You can pretty much guarantee that there is some kind of third party
// library of code that solves this problem. (If you don't want to solve it yourself)
// -------- HAVE A NICE DAY :) -------- //

// Start the session
session_start();

// We use third party code in this project (Plates), and it's downloaded with composer.
// Composer can automatically require "autoload" all of the third party code that we use.
// Whenever you use composer, you'll have to have this line of code somewhere in your project,
// ideally at the very beginning:
require 'vendor/autoload.php';

// Skipping the login system, we'll pretend we're logged in as user 1
$_SESSION['id'] = 1;

// Later on in this code we pick a Page Controller to use.
// These controllers have common functionality (like how all animals communicate, eat, sleep etc)
// and we have a "PageController.php" file that defines all these common functions.
// (Sign up to weekly newsletter, pop-up login box etc)
// Since the individual page controllers (HomeController, ShopController, CheckoutController etc)
// all DEPEND on the functionality of the PageController, we MUST include the PageController
// BEFORE we attempt to use an individual page controller.
require 'app/controllers/PageController.php';

// A cart should exist for every visitor, even if they don't use it.
// BUT WAIT! We don't want to clear the cart every time they view a new page,
// so let's make sure we only create the cart once:
if( !isset($_SESSION['cart']) ) {

  // It's an array because it will hold multiple items.
  $_SESSION['cart'] = [];

}

// Now, what page does the user want to go to?
// If the user has requested a page, then "page=" will be in the address bar ($_GET)
// If the user has literally only just come to the website, then "page=" might not be in the address bar
// So, is there a "page=" or not?
// If there is, take the value. (shop, cart, checkout, home etc)
// If there isn't, take them to "home".
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// It's possible that the page they requested doesn't exist.
// For example: abbbbout, 2012-event, really-old-post
// Maybe we made that typo in our HTML,
// or maybe we deleted the page and someone just used an old bookmark.
// We need to determine which set of Page Controllers are appropriate for the requested page
switch( $page ) {
  // Home page!
  case 'home':
    // Every page has its own controller, this is the controller for the home page
    require 'app/controllers/HomeController.php';
    // But this is just a blueprint. In order to actually USE the HomeController,
    // you must create an "instance" of it.
    // For example: You can't use an elevator when the building is just a blueprint.
    // let's create an instance (tangible, usable, interactive and responsive) of the Home Controller.
    // REMEMBER: If a class (like this HomeController) has a __construct() function, it runs NOW!
    // Not all classes need a contructor function. They are just there to "prepare some stuff for later".
    // For example: Connect to database, get latest posts, get favourite posts if user is logged in etc.
    $controller = new HomeController();
    // We store the controller in a variable because it gets used again later on in this file,
    // so keep scrolling down. (Again, the constructor runs FIRST, so look for it! The code below runs afterwards)
  break;

  // Shop page!
  case 'shop':

  break;

  // Cart page!
  case 'cart':

  break;

  // Checkout page!
  case 'checkout':

  break;

  // Wait, what page? Sorry, I don't know this one... 404 (not found)
  default:
    require 'app/controllers/PageNotFoundController.php';
    $controller = new PageNotFoundController();
  break;
}

// At this point the constructor of the controller that was chosen above has run and finished.
// Ideally it would have obtained all the necessary data for the page to be shown:
// (latest products, processed any forms that were submitted, redirected logged out users from restricted pages)
// Now we're ready to run the function that ALL page controllers have, and that's the buildHTML() function.
// The buildHTML() function exists in each individual page controller (and that's enforced by the PageController)
// but they way they behave might differ depending on the page.
// Thinking of animals again, every animal has a communicate() function, but
// birds chirp, dogs bark, cats meow, and cows moo. They all have common functions but behave differently.
// This is why the buildHTML() function in the PageController is ABSTRACT.
$controller->buildHTML();

// buildHTML() is the last function to run. index.php is finished here so you'll want to take
// a look at the buildHTML() function of the page that is being built.
// This usually just involves picking a template to load and sending it all the data we've gathered from
// the constructor that ran before. The constructor typically triggers a series of other function too,
// so A LOT happens when the constructor is run.
















// Why are you still here? This file is done. Go check out buildHTML().
