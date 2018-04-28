<?php
    interface Specifications
    {
        public function setBrandName($brandName);
        public function setProductName($productName);
        public function getBrandName();
        public function getProductName();
    }

    interface Price
    {
        public function setPrice($price);
        public function getPrice();
        public function setDiscount($discount);
        public function getDiscountedPrice();
    }

    interface Color
    {
        public function setColor($color);
        public function getColor();
    }

    class Product implements Specifications, Price
    {
        private $brandName = 'unknown';
        private $productName = 'unknown';
        private $price = 0;
        private $discount = 0;

        public function setBrandName($brandName)
        {
            $this->brandName = $brandName;
        }

        public function setProductName($productName)
        {
            $this->productName = $productName;
        }

        public function getBrandName()
        {
            return $this->brandName;
        }

        public function getProductName()
        {
            return $this->productName;
        }

        public function setPrice($price)
        {
            $this->price = $price;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function setDiscount($discount)
        {
            if (($discount > 0) && ($discount < 100)) {
                $this->discount = $discount;
            }
        }

        public function getDiscountedPrice()
        {
            $newPrice = round($this->price * (1 - ($this->discount) / 100), 2);
            return $newPrice;
        }

        public function printInfo()
        {
            $info = $this->getBrandName()."\t". $this->getProductName()."\t". $this->getPrice();
            echo $info;
        }

        public function __construct($brandName, $productName, $price, $discount) {
            $this->setBrandName($brandName);
            $this->setProductName($productName);
            $this->setPrice($price);
            $this->setDiscount($discount);
        }
    }
//end clacc Product

//============
    interface Driving
    {
        public function setSpeed($speed);
        public function getSpeed();
    }

    final class Car extends Product implements Color, Driving
    {
        const MAXPRICE = 10000000;
        private $colors = ['white', 'black', 'red', 'gray', 'silver', 'blue'];
        private $color = 'white';
        private $speed = 0;

        public function setColor($color)
        {
            if (((trim($color)) !== null) && (in_array($color, $this->colors))) {
                $this->color = trim($color);
            }
        }

        public function getColor()
        {
            return $this->color;
        }

        public function setSpeed($speed) {
            if (($speed > 0) && ($speed <=300)) {
                $this->speed = (int)$speed;
            }
        }

        public function getSpeed()
        {
            return $this->speed;
        }

        //переопределяем метод printInfo
        public function printInfo()
        {
            $info = "Car: ".$this->getBrandName()."; ".$this->getProductName()."; Color: ".$this->getColor()."; Price: ".$this->getPrice()."; Speed: ".$this->getSpeed()."<br>";
            echo $info;
        }

        public function __construct ($brandName, $modelName, $color, $price, $discount, $speed)
        {
            parent::__construct($brandName, $modelName, $price, $discount);
            $this->setColor($color);
            $this->setSpeed($speed);
        }

    } //end class Car

//================
    interface Writing
    {
        public function write($word);
    }

    final class Pen extends Product implements Color, Writing
    {
        private $type = 'automatic';
        private $material = 'plastic';

        public function setColor($color)
        {
            if ((trim($color)) !== null) {
                $this->color = trim($color);
            }
        }

        public function setType($type)
        {
            if ((trim($type)) !== null) {
                $this->type = trim($type);
            }
        }

        public function setMaterial($material)
        {
            if ((trim($material)) !== null) {
                $this->material = trim($material);
            }
        }

        public function getColor()
        {
            return $this->color;
        }

        public function getType()
        {
            return $this->type;
        }

        public function getMaterial()
        {
            return $this->material;
        }

        public function write($word)
        {
            echo "<p>Pen writing: <b><i>$word</i></b></p>";
        }

        public function printInfo()
        {
            $info = "Pen: ".parent::printInfo()."\t".$this->getColor()."\t".$this->getType()."\t".$this->getMaterial()."<br>";
            echo $info;
        }

        public function __construct ($brandName, $modelName, $price, $discount, $color, $type, $material)
        {
            parent::__construct($brandName, $modelName, $price, $discount);
            $this->setColor($color);
            $this->setType($type);
            $this->setMaterial($material);
        }

    }//end class Pen

//================
    interface ModeSetting
    {
        public function turnOn();
        public function turnOff();
    }

    final class TVset extends Product
    {
      const MAXDIAG = 120;
      private $type = 'LCD';
      private $types = ['LCD', 'plasma', 'OLED', 'tube'];
      private $diagSize = 32;

      public function setType($type)
      {
          if (((trim($type)) !== null) && (in_array($type, $this->types))) {
              $this->type = trim($type);
          }
      }

      public function setDiag($diag)
      {
          if (($diag > 0) && ($diag < (TVset::MAXDIAG))) {
              $this->diagSize = $diag;
          }
      }

      public function getType()
      {
          return $this->type;
      }

      public function getDiag()
      {
          return $this->diagSize;
      }

      public function turnOn()
      {
          echo "<p>TV is On</p>";
      }

      public function turnOff()
      {
          echo "<p>TV is Off</p>";
      }

      public function printInfo()
      {
          $info = "TV: ".parent::printInfo()."\t".$this->getType()."\t ".$this->getDiag().'"'."<br>";
          echo $info;
      }

      public function __construct ($brandName, $modelName, $price, $discount, $type, $diag)
      {
          parent::__construct($brandName, $modelName, $price, $discount);
          $this->setType($type);
          $this->setDiag($diag);
      }

    }//end class TVset

//================

    //класс для работы со списком продуктов
    class ProductList
    {
        private $items = [];
        private $count = 0;

        public function add(Product $item)
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
            }
        }

    }//end class ProductList

//===================
    //теперь занимаемся утками:

    interface Moving
    {
        public function move();
    }

    interface Sound
    {
        public function makeSound();
    }

    abstract class Animal implements Moving, Sound
    {
        public abstract function move();
        public abstract function makeSound();
    }

    class Bird extends Animal
    {
        public function move()
        {
            echo 'Я летаю';
        }

        public function makeSound()
        {
            echo 'Звук птицы';
        }
    }

    final class Duck extends Bird
    {
        private $name = 'duck';

        //переопределяем метод родителя
        public function makeSound()
        {
            echo "Кря-кря! ";
        }

        public function setName($name)
        {
          if ((trim($name)) !== null) {
              $this->name = trim($name);
          }
        }

        //переопределяем метод родителя
        public function move()
        {
            parent::move();
            echo ' и плаваю!';
        }

        public function printInfo()
        {
            echo $this->name." \t ";
            echo $this->makeSound()." \t ".$this->move()."<br>";
        }

        public function __construct($name)
        {
            $this->setName($name);
        }

    }//end class Duck
