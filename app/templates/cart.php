<?php
  $title = 'Cart Page';
  $metaDescription = 'Modify the contents of your cart';

  $this->layout('master', compact('title', 'metaDescription'));
?>

<h1>Your cart: </h1>

<?php

  // There's no point in showing a table of nothing, so we check if there are items in the cart.
  // If not, scroll down a bit until you find the else, and you'll see the alternative message for the user with an empty cart
  if(count($_SESSION['cart']) > 0):

?>

<table border="1">
  <thead>
    <tr>
      <th>Product ID</th>
      <th>Product Name</th>
      <th>Unit Price</th>
      <th>Cart quantity</th>
      <th>Total price</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($_SESSION['cart'] as $cartItem): ?>
    <tr>
      <td><?= $cartItem['id'] ?></td>
      <td><?= $cartItem['name'] ?></td>
      <td>$<?= $cartItem['price'] ?></td>
      <td><?= $cartItem['quantity'] ?></td>
      <td>$<?= $cartItem['quantity'] * $cartItem['price'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>

  <p>
    You have an empty cart! Why not check out the <a href="index.php?page=shop">Shop</a>
  </p>

<?php endif; ?>
