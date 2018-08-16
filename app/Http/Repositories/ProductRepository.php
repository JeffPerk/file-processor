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
        $product->profit_total = money_format("$%!i", $profitTotal);
        setlocale(LC_MONETARY, "en_CA");
        $product->canadian_profit_total = money_format("$%!i", $currencyData['result']);
        return $product;
    }
}