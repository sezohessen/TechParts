<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class paymentsController extends Controller
{
    use GeneralTrait;
    const PAYMENT_INTEGRATION_CARD_ID = 164092 ;
    const PAYMENT_MERCHANT_ID = 63503;
    const PAYMENT_IFRAME_KAY = 159792;
    const PAYMENT_API_KAY = "ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2libUZ0WlNJNkltbHVhWFJwWVd3aUxDSndjbTltYVd4bFgzQnJJam8yTXpVd00zMC5LamkyM1VfdVBCZnEwck1Cb2FnUmsxdjN5TTFtdkd4UXpmdHRhSzk0ZHM4VlpjNkVyZkVtajd2R3ZwMDVaSUc3YkI0ZTBkWmJpZFZ3T0RQcE53UFZ1Zw==";
    const PAYMENT_BASE_URL = "https://accept.paymobsolutions.com/api/acceptance/iframes/";

    public function get_payment_order_token($user, $price, $currency )
    {
        $currency = $currency ? $currency : 'EGP';
        $user_id = $user->id;
        try {
            $url = "https://accept.paymobsolutions.com/api/auth/tokens";
            $header = array(
                'Content-Type: application/json'
            );
            $fields = array(
                'api_key' => self::PAYMENT_API_KAY,
            );
            $fields = json_encode($fields);
            $data =  $this->api_parser($url, $fields, $header);
            $data = json_decode($data);
            $auth_token = $data->token;
            $url = "https://accept.paymobsolutions.com/api/ecommerce/orders";
            $fields = array(
                "auth_token" => $auth_token,
                "merchant_id" => self::PAYMENT_MERCHANT_ID,
                "merchant_order_id" => strtotime(Carbon::now()) + $user_id + rand(1000, 9999),
                "amount_cents" => $price * 100,
                "expiration" => 36000,
                "order_id" => mt_rand(1000, 10000000000),
                "billing_data" => [
                    "apartment" => "NA",
                    "email" => $user->email,
                    "floor" => "NA",
                    "first_name" => $user->first_name,
                    "street" => "NA",
                    "building" => "NA",
                    "phone_number" => $user->phone,
                    "shipping_method" => "PKG",
                    "postal_code" => "NA",
                    "city" => "NA",
                    "country" => "NA",
                    "last_name" => $user->last_name,
                    "state" => "NA",
                ],
                "currency" => $currency,
                "integration_id" => self::PAYMENT_INTEGRATION_CARD_ID,
                "lock_order_when_paid" => "false"
            );
            $fields = json_encode($fields);
            $data = json_decode($this->api_parser($url, $fields, $header));
            return  self::PAYMENT_BASE_URL.self::PAYMENT_IFRAME_KAY."?payment_token=".$data->token;
        }catch (\Exception $ex){
            return false;
        }
    }
    public function payments_token(Request $request)
    {
        $this->lang($request->lang);
        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer',
            'currency' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $user = auth()->user();
        $data = $this->get_payment_order_token($user, $request->amount, $request->currency);
        if (!$data) {
            $this->errorMessage($data);
        }
        return $this->returnData('payment_url', $data, __('Generate Payment Successfully'));
    }

    public function api_parser($url,$fields, $header = array()){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
