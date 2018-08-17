<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['sku', 'price', 'cost', 'quantity'];

    protected $sku;
    protected $price;
    protected $cost;
    protected $quantity;

    public function __construct($sku = "", $price = "", $quantity = "", $cost = "")
    {
        $this->sku = $sku;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->cost = $cost;
    }

    /**
    * Get the sku
    *
    * @return string
    */
    public function getSku () {
        return $this->sku;
    }

    /**
    * Get the price
    *
    * @return string
    */
    public function getPrice () {
        return $this->price;
    }

    /**
    * Get the cost
    *
    * @return string
    */
    public function getCost () {
        return $this->cost;
    }

    /**
    * Get the quantity
    *
    * @return string
    */
    public function getQuantity () {
        return $this->quantity;
    }

    /**
    * Set the sku
    *
    * @param string $sku
    * @return this
    */
    public function setSku ($sku) {
        $this->sku = $sku;
        return $this;
    }

    /**
    * Set the price
    *
    * @param string $price
    * @return this
    */
    public function setPrice ($price) {
        $this->sku = $price;
        return $this;
    }

    /**
    * Set the cost
    *
    * @param string $cost
    * @return this
    */
    public function setCost ($cost) {
        $this->sku = $cost;
        return $this;
    }

    /**
    * Set the quantity
    *
    * @param string $quantity
    * @return this
    */
    public function setQuantity ($quantity) {
        $this->sku = $quantity;
        return $this;
    }
}
