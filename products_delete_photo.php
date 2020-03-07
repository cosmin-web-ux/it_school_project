<?php

include 'config/init.php';

if (!empty($_GET['id'])) {
  $productDb = new Product();
  $photo = $productDb->getPhotoById($_GET['id']);

  if ($photo) {
    unlink('media/products/' . $photo['filename']);
    $productDb->deletePhoto($_GET['id']);
    header('Location: products_edit.php?id=' . $photo['product_id']);
  }
}
