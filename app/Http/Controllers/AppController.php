<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AppController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin');
    }

    public function index()
    {
        $categories = Category::select('id', 'name', 'image')->where('type', 'parts')->get();
        return view('app.index', compact('categories'));
    }

    public function custom_logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function get_gold_price()
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
