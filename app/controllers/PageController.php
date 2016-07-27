<?php

// A class is a blueprint. An idea. It is not usable until you create an instance of it.
// This class is set to abstract because it MAKES NO SENSE to create something out of it.
// It's literally half a blueprint. The other controllers (HomeController, CheckoutController)
// all base themselves off of this PageController and you end up with a full picture.
// For example: You can't create Animal, but you can create Bird, Cat, Dog which are BASED on the Animal class.
abstract class PageController {

  // Properties are good for storing stuff
  // If you think about Humans, we might have:
  // hairColour
  // birthday
  // fullName
  // etc
  // Now, in the context of web, all pages probably need a connection to the database:
  protected $dbc;
  // It's "protected" because code OUTSIDE this class shouldn't have access to it
  // (imagine your bank account contents being publicly available)
  // BUT it's still inheritable by classes that EXTEND this one.
  // The other options are:
  // public: Can be used / changed by any code anywhere in this app.
  // private: Can only be used / changed by code in THIS class.
  // protected: Like private, but is inherited by child classes. (HomeController etc)

  // Plates is a templating system that we use to help us build HTML pages.
  // We use this later but it has to be stored somewhere, so here is where it will be stored:
  protected $plates;

  // We will be processing / obtaining a lot of data in these controllers, and when we
  // are finally ready to display that data we will send it all to the template files
  // That data has to be saved somewhere, so here is an array to hold it all:
  protected $data = [];
  // We're starting this off as an array because it makes it easier to add stuff to it without
  // having to see if it's an array yet. It's always an array now, so fill it up!

  // Well that's pretty much it for properties. Now for methods:
  // METHODS (functions) are chunks of related code that perform a job.
  // For example: Process a form, upload an image, get the latest products, etc
  // EVERY page in this website is using the Plates library, so why don't we start it up and
  // make it ready to use later on? If we store it in a property, it'll stick around until the
  // code is finished at the end of the index.php file.
  // We could probably do this IMMEDIATELY after a line of code creates an instance of this class
  // (Technically, we will be creating an instance of the CHILD classes. HomeController, CheckoutController etc)
  // The constructor is good for this:
  public function __construct() {

    // This code runs IMMEDIATELY after this class is instantiated.
    // See index.php where it says $controller = new HomeController();

    // All the code that makes Plates work is in a file under the vendor/ folder.
    // We use COMPOSER on the COMMAND LINE to download Plates, and now we are ready to use it.
    // The cool thing about composer is that it makes all the stuff we download READY TO USE RIGHT AWAY!
    // We don't need to "require" or "include" anything like we did with the controllers in the app/controllers folder.
    // Refer to the README.md file for instructions on using composer
    // We need to create an instance of Plates and store it in a property for use later on:
    $this->plates = new League\Plates\Engine('app/templates');
    // All\those\backslashes\in\that\line are saying that Plates uses NAMESPACES.
    // Sometimes people might write code that has the same names as other code, and this causes conflict.
    // You can't have two files of the same name in a folder. The same concept applies here with namespaces.
    // These are pretty much imaginary folders that the Plates library uses to say where things can be found.
    // For example: Awesome\Code won't conflict with Brilliant\Code, even though they are both called "Code".
    // Plates named all the code that you interact with as "Engine". It's totally possible that someone else
    // called their code "Engine" too, so namespaces prevent conflict.

    // HERE'S SOMETHING DIFFERENT!
    // Instead of connecting to the database in the index.php file and having to pass around a $dbc variable
    // why don't we connect to the database here?
    $this->dbc = new mysqli('localhost', 'root', '', 'my_online_shop_database');
    // Ideally this sensitive information would be stored somewhere else and untracked by git.

  }

  // Every page in this website will have HTML, but it's different for each page. Just like how every animal "communcates",
  // but it's different for each animal.
  // So we need to ENFORCE THIS AS LAW, but we can't DEFINE how that actually works. The individual page controllers will NEED
  // to define this functionality.
  abstract public function buildHTML();
  // Note the absence of curly brackets. Those are only used when you actually have code to write.
  // Also note the public accessibility of this function. It gets called from index.php when it's ready,
  // but that wouldn't work if it were private or protected.

}
























//
