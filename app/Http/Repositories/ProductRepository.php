<?php

namespace App\Http\Repositories;

use App\Product;
use App\Http\Services\CurrencyConverter;

class ProductRepository {

    protected $currencyConverter;

    public function __construct(CurrencyConverter $currencyConverter)
    {
        $this->converter = $currencyConverter;
    }

    public function updateProduct(Product $product, $profitMargin, $profitTotal)
    {
        $currencyData = $this->converter->convertCurrency($profitTotal);
        $product->profit_margin = $profitMargin;
        setlocale(LC_MONETARY, "en_US");
        $product->profit_total = $profitTotal;
        setlocale(LC_MONETARY, "en_CA");
        if (array_key_exists('result', $currencyData)) {
            $product->canadian_profit_total = array_get($currencyData, 'result');
        }

        return $product;
    }
}