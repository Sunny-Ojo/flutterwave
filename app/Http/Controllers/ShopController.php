<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Shop;
use App\Wishlist;

class ShopController extends Controller
{
    //
    public function viewUserProducts()
    {
        $auth = auth()->user()->id;
        $userproducts = Shop::where('user_id', $auth)->paginate(6);
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->paginate(6);
        $cart = Cart::where('user_id', auth()->user()->id)->paginate(9);
        $cat = Category::all();
        $products = Shop::orderBy('created_at', 'desc')->paginate(9);
        return view('user.allproducts')->with(['userproducts' => $userproducts, 'wishlist' => $wishlist, 'cart' => $cart, 'cat' => $cat, 'products' => $products]);

    }
    public function about()
    {

        $cat = Category::all();
        $products = Shop::orderBy('created_at', 'desc')->paginate(9);
        return view('about')->with(['cat' => $cat, 'products' => $products]);

        # code...
    }
    public function contact()
    {

        $cat = Category::all();
        $products = Shop::orderBy('created_at', 'desc')->paginate(9);
        return view('contact')->with(['cat' => $cat, 'products' => $products]);

    }
    public function checkout($amount)
    {

        $curl = curl_init();

        $customer_email = auth()->user()->email;
        $amount = $amount;
        $currency = "NGN";
        $txref = "rave" . '-' . time(); // ensure you generate unique references per transaction.
        $PBFPubKey = "FLWPUBK_TEST-e509057b9c4d6bb6e572bb801ad3982e-X"; // get your public key from the dashboard.
        $redirect_url = "/products";

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'customer_email' => $customer_email,
                'currency' => $currency,
                'txref' => $txref,
                'PBFPubKey' => $PBFPubKey,
                'redirect_url' => $redirect_url,
            ]),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "cache-control: no-cache",
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the rave API
            die('Curl returned error: ' . $err);
        }

        $transaction = json_decode($response);

        if (!$transaction->data && !$transaction->data->link) {
            // there was an error from the API
            print_r('API returned error: ' . $transaction->message);
        }

// uncomment out this line if you want to redirect the user to the payment page
        //print_r($transaction->data->message);

// redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page
        header('Location: ' . $transaction->data->link);
    }
}