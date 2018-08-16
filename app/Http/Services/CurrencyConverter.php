<?php

namespace App\Http\Services;

class CurrencyConverter {

    public function convertCurrency($profitTotal)
    {
        $url = "http://data.fixer.io/api/";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url . "convert?access_key=". env('FIXER_API_KEY') . "&from=USD&to=CAD&amount=" . $profitTotal,
            CURLOPT_USERAGENT => "Fixer Request"
        ]);
        $data = curl_exec($curl);
        $data = json_decode($data, true);
        curl_close($curl);

        return $data;
    }
}