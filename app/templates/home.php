<?php

  // THIS FILE IS ONLY PART OF A WHOLE PAGE!
  // We have another file called "master.php" which contains things
  // like the title, meta description, the nav bar and footer too.
  // The reason these HTML files are split up is so we can recycle and reuse as much code as possible!

  // It's better to update one thing that affects 100 files than it is to update 100 files to change one thing.

  // The master template needs a title and meta description, and since this template is SPECIFICALLY for the home page,
  // we can write those right here!
  $title = 'Home Page';
  $metaDescription = 'See our latest products and maybe buy a gift for a friend!';

  // Now that we have that data, let's send it to the master template:
  $this->layout('master', compact('title', 'metaDescription'));

  // That's different. What is it doing?
  // 1. You give the compact function a list of variable names to look for.
  // 2. compact will find those variables and package them up into an array
  // 3. When this array is sent to the master layout, the variables are extracted with the same names,
  //    so master.php will have a $title and $metaDescription to use!
  // Teleportation!

?>

<h1>Home page</h1>

<h2>Latest products</h2>

<?php foreach($theTenLatestProducts as $oneOfTheProducts): ?>

<article>
  <h1><?= $oneOfTheProducts['name'] ?></h1>
  <img src="http://placehold.it/320x180" alt="" />
  <ul>
    <li>Price: $<?= $oneOfTheProducts['price'] ?></li>
    <li>Product was added: <?= $oneOfTheProducts['date_added'] ?></li>
    <li><a href="index.php?page=add-to-cart&id=<?= $oneOfTheProducts['id'] ?>">Add to cart</a></li>
  </ul>
</article>

<?php endforeach; ?>
