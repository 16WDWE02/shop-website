<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- The $title variable comes from the individual page templates -->
    <title><?= $title ?></title>
    <!-- The $metaDescription variable comes from the individual page templates -->
    <meta name="description" content="<?= $metaDescription ?>">
  </head>
  <body>
    <nav>
      <ul>
        <li><a href="index.php?page=home">Home</a></li>
        <li><a href="index.php?page=shop">Shop</a></li>
        <li><a href="index.php?page=checkout">Checkout</a></li>
      </ul>
    </nav>

    <main>
      <!-- All of the content from the individual page templates will be put here -->
      <?= $this->section('content') ?>
    </main>

    <footer>
      <!-- The date function here will show the current year (according to the server) -->
      <p>Copyright <?= date('Y') ?> Your name here</p>
    </footer>
  </body>
</html>
