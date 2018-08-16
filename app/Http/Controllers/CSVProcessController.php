<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Controllers\Controller;

class CSVProcessController extends Controller {
    /*
     * Controller formats csv file data and returns to view
     */

    public function processCSVFile() {
        $data = $this->csvToArray(request('csv-upload'));
        dd($data);
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
}