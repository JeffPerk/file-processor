<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Controllers\Controller;

class CSVProcessController extends Controller {
    /*
     * Controller formats csv file data and returns to view
     */

    public function processCSVFile() {
        $productsArray = [];
        $products = $this->csvToArray(request('csv-upload'));
        foreach ($products as $product) {
            $newProduct = new Product($product["sku"], $product["price"], $product["qty"], $product["cost"]);
            array_push($productsArray, $newProduct);
        }

        foreach ($productsArray as $product) {
            $this->calculateProfitMargin($product->getCost(), $product->getPrice(), $product->getQuantity());
        }
        return view('results')->with(["products" => $productsArray]);
    }

    private function csvToArray($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();
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

    private function calculateProfitMargin($cost, $price, $qty)
    {
        dd($cost, $price, $qty);
    }
}