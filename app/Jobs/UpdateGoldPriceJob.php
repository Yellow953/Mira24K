<?php

namespace App\Jobs;

use App\Models\General;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class UpdateGoldPriceJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    public function __construct() {}

    public function handle(): void
    {
        $gold_price = $this->get_gold_price();

        if ($gold_price && is_numeric($gold_price)) {
            General::updateOrCreate(
                ['title' => 'gold_price'],
                ['value' => $gold_price]
            );

            Log::create(['text' => "Gold Price Updated to " . $gold_price . ", datetime:" . now()]);
        } else {
            Log::create(['text' => "Couldn't update Gold Price, datetime:" . now()]);
        }
    }

    private function get_gold_price()
    {
        $apiKey = "goldapi-1vro19m3ft72am-io";
        $symbol = "XAU";
        $curr = "USD";
        $date = "";

        $myHeaders = array(
            'x-access-token: ' . $apiKey,
            'Content-Type: application/json'
        );

        $curl = curl_init();

        $url = "https://www.goldapi.io/api/{$symbol}/{$curr}{$date}";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => $myHeaders
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            return 'Error: ' . $error;
        } else {
            $data = json_decode($response, true);

            if (isset($data['price'])) {
                return $data['price'];
            } else {
                return 'Error: Price data not found in response.';
            }
        }
    }
}
