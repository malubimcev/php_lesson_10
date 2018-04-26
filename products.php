<?php
    interface NewSpecifications
    {
        public function setProductName($productName);
        public function getProductName();
    }

    interface NewPrice
    {
        public function setPrice($price);
        public function getPrice();
        public function setDiscount($discount);
        public function getDeliveryPrice();
    }

    trait PriceCalculation
    {
        public function getDiscountedPrice($price, $discount)
        {
            if (($discount > 0) && ($discount <= 100)) {
                $newPrice = round($price * (1 - $discount / 100), 2);
            } else {
                $newPrice = $price;
            }
            return $newPrice;
        }
    }

    //базовый класс продукта
    class NewProduct implements NewSpecifications, NewPrice
    {
        use PriceCalculation;

        private $brandName = 'unknown';
        private $productName = 'unknown';
        private $price = 0;
        private $discount = 0;
        private $deliveryPrice = 250;
        private $weight = 0;

        public function setProductName($productName)
        {
            $this->productName = $productName;
        }

        public function getProductName()
        {
            return $this->productName;
        }

        public function setPrice($price)
        {
            $this->price = $price;
        }

        public function setDiscount($discount)
        {
            if (($discount > 0) && ($discount < 100)) {
                $this->discount = $discount;
                $this->deliveryPrice = 300;
            } else {
                $this->discount = 0;
                $this->deliveryPrice = 250;
            }
        }

        public function setWeight($weight)
        {
            if ($weight > 0) {
                $this->weight = $weight;
                if ($weight <= 10) {
                    $this->setDiscount(0);
                }
            }
        }

        public function getPrice()
        {
            return $this->getDiscountedPrice($this->price, $this->discount);
        }

        public function getDeliveryPrice()
        {
            return $this->deliveryPrice;
        }

        public function printInfo()
        {
            $info = "Продукт: ".$this->getProductName().";\t Цена: ". $this->getPrice().";\t Доставка: ".$this->getDeliveryPrice().";\t Вес: ".$this->weight;
            echo $info;
        }

        public function __construct($productName, $price, $discount, $weight) {
            $this->setProductName($productName);
            $this->setPrice($price);
            $this->setDiscount($discount);
            $this->setWeight($weight);
        }
    }//end clacc Product

    //класс - наследник NewProduct
    final class Food extends NewProduct
    {

        public function printInfo()
        {
            parent::printInfo();
        }

        public function __construct($productName, $price, $discount, $weight)
        {
            parent::__construct($productName, $price, $discount, $weight);
            if ($weight <= 10) {
                $this->setDiscount(0);
            }

        }

    }//end clacc Food

    //класс - наследник NewProduct
    final class Mebel extends NewProduct
    {
        public function printInfo()
        {
            parent::printInfo();
        }

        public function __construct($productName, $price, $discount, $weight)
        {
            parent::__construct($productName, $price, $discount, $weight);
        }

    }//end clacc Mebel

    //класс - наследник NewProduct
    final class Bike extends NewProduct
    {
        public function printInfo()
        {
            parent::printInfo();
        }

        public function __construct($productName, $price, $discount, $weight)
        {
            parent::__construct($productName, $price, $discount, $weight);
        }

    }//end clacc Bike

    class NewProductList
    {
        private $items = [];
        private $count = 0;

        public function add(NewProduct $item)
        {
            if (isset($item)) {
                $this->count++;
                $key = $this->count;
                $this->items[$key] = &$item;
            }
        }

        public function delete($key)
        {
            if (isset($key, $this->items)) {
                unset($this->items[$key]);
                $this->count--;
            }
        }

        public function printList()
        {
            foreach ($this->items as $key => $item) {
                $item->printInfo();
                echo "<br>";
            }
        }

    }//end class ProductList
