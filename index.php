<!DOCTYPE html>
<?php
    require_once 'classes.php';
    require_once 'products.php';

    $car = new Car('BMW', 'M5', 'black', 60000, 5);
    $pen = new Pen('FamousPenBrand', 'LegendModel', 500, 5, 'black', '_t', '_m');
    $tv = new TVset('Philips', 'NewTV', 30000, 3, 'LCD', 42);
    $duck = new Duck('Утка');
    $productList = new ProductList();
    $productList->add($car);
    $productList->add($pen);
    $productList->add($tv);

    $product1 = new Food('пицца', 600, 10, 1);
    $product2 = new Bike('велосипед_1', 14000, 10, 15);
    $product3 = new Mebel('кровать', 25000, 0, 50);
    $product4 = new Food('торт', 1500, 10, 2);
    $product5 = new Bike('велосипед_2', 25000, 10, 13);
    $product6 = new Mebel('шкаф', 20000, 0, 40);
    $foodList = new NewProductList();
    $foodList->add($product1);
    $foodList->add($product2);
    $foodList->add($product3);
    $foodList->add($product4);
    $foodList->add($product5);
    $foodList->add($product6);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Classes</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <h1>Наследование и интерфейсы</h1>
        <h2>Основная часть задания</h2>
        <?php
            echo $productList->printList();
            echo $duck->printInfo();
        ?>
        <h2>Дополнительное задание</h2>
        <?php
            echo $foodList->printList();
        ?>
    </body>
</html>
