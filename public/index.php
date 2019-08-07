<?php
require '../src/Products.php';

$products = new Products();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sweet Store Inventory</title>
</head>
<body>
<div>
    <header>
        <h1>Product Weekly Summary</h1>
    </header>
    <div>
        <h4>Brownie:</h4>
        <p>Total Units Sold: <?php echo $products->getSoldTotal($products::BROWNIE) ?></p>
    </div>
    <div>
        <h4>Lamington:</h4>
        <p>Total Units Sold: <?php echo $products->getSoldTotal($products::LAMINGTON) ?></p>
    </div>
    <div>
        <h4>Blueberry Muffin:</h4>
        <p>Total Units Sold: <?php echo $products->getSoldTotal($products::BLUEBERRY_MUFFIN) ?></p>
    </div>
    <div>
        <h4>Croissant:</h4>
        <p>Total Units Sold: <?php echo $products->getSoldTotal($products::CROISSANT) ?></p>
    </div>
    <div>
        <h4>Chocolate Cake:</h4>
        <p>Total Units Sold: <?php echo $products->getSoldTotal($products::CHOCOLATE_CAKE) ?></p>
    </div>
</div>
</body>
</html>
