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
        public function setDeliveryPrice($deliveryPrice);
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

    class NewProduct implements NewSpecifications, NewPrice
    {
        use PriceCalculation;

        private $brandName = 'unknown';
        private $productName = 'unknown';
        private $price = 0;
        private $discount = 0;
        private $deliveryPrice = 0;

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
            }
        }

        public function setDeliveryPrice($deliveryPrice)
        {
            $this->deliveryPrice = $deliveryPrice;
        }

        public function getPrice()
        {
            $newPrice = getDiscountedPrice($this->price, $this->discount);
            return $newPrice;
        }

        public function getDeliveryPrice()
        {
            return $this->deliveryPrice;
        }

        public function printInfo()
        {
            $info = $this->getProductName()."\t". $this->getPrice()."\t".$this->getDeliveryPrice();
            echo $info;
        }

        public function __construct($productName, $price, $discount, $deliveryPrice) {
            $this->setProductName($productName);
            $this->setPrice($price);
            $this->setDiscount($discount);
            $this->setDeliveryPrice($deliveryPrice);
        }
    }
//end clacc Product

    final class Food extends NewProduct
    {
        private $weight = 0;

        public function setWeight($weight)
        {
            if ($weight > 0) {
                $this->weight = $weight;
                if ($weight <= 10) {
                    $this->setDiscount(0);
                }
            }
        }

        public function printInfo()
        {
            parent::printInfo();
            echo $this->weight;
        }

        public function __construct($productName, $price, $discount, $deliveryPrice, $weight)
        {
            parent::__construct($productName, $price, $discount, $deliveryPrice);
            $this->setWeight($weight);
        }
    }

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
            }
        }

    }//end class ProductList
