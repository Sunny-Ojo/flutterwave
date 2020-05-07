<?php

namespace App\Http\Controllers;

use App\Children;
use App\Teachers;
use DB;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function children()
    {
        $provinces = DB::select('select *  from province');

        return view('children')->with(['provinces' => $provinces]);

    }
    public function teachers()
    {
        $provinces = DB::select('select *  from province');

        return view('teachers')->with(['provinces' => $provinces]);
    }
    public function teenagers()
    {
        return view('teenagers');
    }
    public function childrenPayment(Request $request)
    {

        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'region' => 'required',
            'province' => 'required',
            'number' => 'required',
            'number_of_forms' => 'required',
            'number_of_children_or_teens' => 'required',
        ]);
        $storeData = $request->all();
        $saveDetails = $request->session()->put('userdetails', $storeData);

        $numberOfTeens = $request->number_of_children_or_teens;
        $total = $numberOfTeens * 200;
        $curl = curl_init();

        $customer_email = $request->email;
        $amount = $total;
        $setAmount = $request->session()->put('teachersamount', $amount);
        $currency = "NGN";
        $txref = "rave-rccg" . time(); // ensure you generate unique references per transaction.
        $PBFPubKey = "FLWPUBK-896d352443ef166c7d6af8233840685e-X"; // get your public key from the dashboard.
        $redirect_url = "/teenspayment/successful";

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
        return redirect($transaction->data->link);
    }
    public function validateChildrenPayment(Request $request)
    {

        if (isset($_GET['txref'])) {
            $ref = $_GET['txref'];
            $getAmount = $request->session()->pull('amount');
            $amount = $getAmount; //Correct Amount from Server
            $currency = "NGN"; //Correct Currency from Server

            $query = array(
                "SECKEY" => "FLWSECK-dd94408b299955e21c4873cd6ed1514f-X",
                "txref" => $ref,
            );

            $data_string = json_encode($query);

            $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);

            curl_close($ch);

            $resp = json_decode($response, true);

            $paymentStatus = $resp['data']['status'];
            $chargeResponsecode = $resp['data']['chargecode'];
            $chargeAmount = $resp['data']['amount'];
            $chargeCurrency = $resp['data']['currency'];

            if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount) && ($chargeCurrency == $currency)) {
                // transaction was successful...
                // please check other things like whether you already gave value for this ref
                // if the email matches the customer who owns the product etc
                //Give Value and return to Success page

                //save the details in database;
                $getData = $request->session()->pull('userdetails');
                $user = (object)$getData;

                $teen = new Children();
                $teen->firstName = $user->firstName;
                $teen->lastName = $user->lastName;
                $teen->email = $user->email;
                $teen->region = $user->region;
                $teen->province = $user->province;
                $teen->phone = $user->number;
                $teen->forms = $user->number_of_forms;
                $teen->total_paid_for = $user->number_of_children_or_teens;
                $teen->ref_id = $ref;
                $teen->amount_paid = $getAmount;
                $teen->save();
                return view('payment')->with(['txref' => $ref, 'amount' => $getAmount]);

            } else {

                //Dont Give Value and return to Failure page

                return view('failed');
            }
        } else {
            die('No reference supplied');
        }

    }
    public function teachersPayment(Request $request)
    {

        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'region' => 'required',
            'province' => 'required',
            'number' => 'required',
            'number_of_forms' => 'required',
            'number_of_teachers' => 'required',
        ]);
        $storeData = $request->all();
        $saveDetails = $request->session()->put('teachersdetails', $storeData);

        $numberOfTeens = $request->number_of_teachers;
        $total = $numberOfTeens * 500;
        $curl = curl_init();

        $customer_email = $request->email;
        $amount = $total;
        $setAmount = $request->session()->put('teachersamount', $amount);
        $currency = "NGN";
        $txref = "rave-rccg" . time(); // ensure you generate unique references per transaction.
        $PBFPubKey = "FLWPUBK-896d352443ef166c7d6af8233840685e-X"; // get your public key from the dashboard.
        $redirect_url = "https://dev.rccglp33juniorchurch.com/validate/teacherspayment";

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
        return redirect($transaction->data->link);
    }
    public function validateTeachersPayment(Request $request)
    {
        if (isset($_GET['txref'])) {
            $ref = $_GET['txref'];
            $getAmount = $request->session()->pull('teachersamount');
            $amount = $getAmount; //Correct Amount from Server
            $request->session()->forget('teachersamount');
            $currency = "NGN"; //Correct Currency from Server

            $query = array(
                "SECKEY" => "FLWSECK-63a286eb160b138741ac247d0c52fc0a-X",
                "txref" => $ref,
            );

            $data_string = json_encode($query);

            $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);

            curl_close($ch);

            $resp = json_decode($response, true);

            $paymentStatus = $resp['data']['status'];
            $chargeResponsecode = $resp['data']['chargecode'];
            $chargeAmount = $resp['data']['amount'];
            $chargeCurrency = $resp['data']['currency'];

            if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount) && ($chargeCurrency == $currency)) {
                // transaction was successful...
                // please check other things like whether you already gave value for this ref
                // if the email matches the customer who owns the product etc
                //Give Value and return to Success page
                $getData = $request->session()->pull('teachersdetails');
                $user = (object)$getData;
                $teacher = new Teachers();
                $teacher->firstName = $user->firstName;
                $teacher->lastName = $user->lastName;
                $teacher->email = $user->email;
                $teacher->region = $user->region;
                $teacher->province = $user->province;
                $teacher->phone = $user->number;
                $teacher->forms = $user->number_of_forms;
                $teacher->total_paid_for = $user->number_of_teachers;
                $teacher->ref_id = $ref;
                $teacher->amount_paid = $getAmount;
                $teacher->save();
                return view('payment');
            } else {

                //Dont Give Value and return to Failure page

                return view('failed');
            }
        } else {
            die('No reference supplied');
        }

    }

}