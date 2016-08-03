<?php
  $title = 'Shop Page';
  $metaDescription = 'View all of our products';

  $this->layout('master', compact('title', 'metaDescription'));
?>

<h1>All products (<?= count($allProducts) ?>)</h1>

<?php

  // It's entirely possible that there are no products.
  // Tell the user this problem, OR show them the products!
  if( count($allProducts) > 0 ):
  // Look for the else: further down.

?>

<?php foreach($allProducts as $oneOfTheProducts): ?>

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

<?php else: ?>

  <p>
    There are no products for sale at the moment.
  </p>

<?php endif; ?>
