<?php
    class Product{
        public $id;
        public $name;
        public $description;
        public $base_price;
        public $img;
        public $category_id;
        public $fabricante;
        public $stock;
        public $active;

        public $offers_id;
        public $offers_name;
        public $offers_type;
        public $offers_value;

        public $category_name;

        public function getIdProduct() {return $this->id;}
        public function getNameProduct() {return $this->name;}
        public function getDescriptionProduct() {return $this->description;}
        public function getBasePriceProduct() {return $this->base_price;}
        public function getImgProduct() {return $this->img;}
        public function getIdCategory() {return $this->category_id;}
        public function getFabricProduct() {return $this->fabricante;}
        public function getStockProduct() {return $this->stock;}

        public function getIdOffers() {return $this->offers_id;}
        public function getNameOffers() {return $this->offers_name;}
        public function getTypeOffers() {return $this->offers_type;}
        public function getValueOffers() {return $this->offers_value;}

        public function getNameCategory() { return $this->category_name;}

        
        public function hasOffer() {
            return $this->offers_id !== null;
        }

        public function getFinalPrice() {
            if (!$this->hasOffer()) {
                return round($this->base_price,2);
            }

            if ($this->offers_type == "percentage") {
                return round($this->base_price * (1 - $this->offers_value / 100),2);
            }

            if ($this->offers_type == "fixed") {
                return round($this->base_price - $this->offers_value,2);
            }
        }

        public function getOffer() {
            switch ($this->offers_type) {
                case 'percentage':
                    return $this->offers_value."%";
                    break;
                case 'fixed':
                    return "-".$this->offers_value."€";
                    break;
                default:
                    return "Error";
                    break;
            }
        }
    }
?>