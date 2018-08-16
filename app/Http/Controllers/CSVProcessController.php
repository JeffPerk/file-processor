<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Repositories\ProductRepository;
use App\Http\Controllers\Controller;

class CSVProcessController extends Controller {
    /*
     * Controller formats csv file data and returns to view
     */
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function processCSVFile() {
        $productsArray = [];
        $products = $this->csvToArray(request('csv-upload'));
        foreach ($products as $product) {
            $newProduct = new Product($product["sku"], $product["price"], $product["qty"], $product["cost"]);
            array_push($productsArray, $newProduct);
        }

        foreach ($productsArray as $product) {
            $product = $this->calculateProfits($product, $product->getCost(), $product->getPrice(), $product->getQuantity());
        }

        $viewData = $this->calculateAverages($productsArray);
        return view('results')->with(["products" => $productsArray, 'footerData' => $viewData]);
    }

    private function csvToArray($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = [];
        if (($handle = fopen($filename, 'r')) !== false)  {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                }
                else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }

    private function calculateProfits($product, $cost, $price, $qty)
    {
        $totalCost = $cost * $qty;
        $revenue = $qty * $price;
        $profit = $revenue - $totalCost;
        $profitMargin = ($profit / $revenue) * 100;
        $product = $this->repository->updateProduct($product, $profitMargin, $profit);
    }

    private function calculateAverages($products) {
        if (!$products) {
            return false;
        }

        $priceCount = 0;
        $profitMarginCount = 0;
        $avgPrice = 0;
        $totalQty = 0;
        $avgProfitMargin = 0;
        $totalProfitUSD = 0;
        $totalProfitCAD = 0;
        foreach ($products as $product) {
            if ($product->getPrice()) {
                $priceCount++;
            }
            if ($product->profit_margin) {
                $profitMarginCount++;
            }
            $avgPrice += $product->getPrice();
            $totalQty += $product->getQuantity();
            $avgProfitMargin += $product->profit_margin;
            $totalProfitUSD += $product->profit_total;
            $totalProfitCAD += $product->canadian_profit_total;
        }

        $avgPrice = $avgPrice / $priceCount;
        $avgProfitMargin = $avgProfitMargin / $profitMarginCount;

        $viewData = [
            'average_price'         => $avgPrice,
            'total_quantity'        => $totalQty,
            'average_profit_margin' => $avgProfitMargin,
            'total_profit_usd'      => $totalProfitUSD,
            'total_profit_cad'      => $totalProfitCAD
        ];

        return $viewData;
    }
}