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

    $food1 = new Food('Food_1',1000,5,250,1);
    $food2 = new Food('Food_2',2000,10,250,12);
    $food3 = new Food('Food_3',5000,5,250,5);
    $foodList = new NewProductList();
    $foodList->add($food1);
    $foodList->add($food2);
    $foodList->add($food3);
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
            echo $foodList->printList().'</div>';
        ?>
    </body>
</html>
