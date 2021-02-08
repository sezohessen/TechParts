<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;


use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator as Validator;

use App\Models\Bank;
use App\Models\BankContact;
use App\Models\BankOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    use GeneralTrait;
    public function home(Request $request)
    {
        $this->lang($request->lang);
        $validator  = Validator::make(
            (array) $request->all(),
            [
                'interest_country'      => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }

        $banks   = Bank::whereHas('user', function ($query) use ($request) {
            return $query->where('users.interest_country', $request->interest_country);
        })
            ->select(['*', DB::raw('IF(`order` IS NOT NULL, `order`, 1000000) `order`')])
            /*
            The IF statement solves the issue here. If NULL value is found,
            some big number is assigned to order instead.
            If found not NULL value, real value is used.
         */
            ->orderBy('order', 'asc')
            ->get();
        if (!$banks->count()) {
            return $this->errorMessage(__('No banks found to be showen.'));
        }
        $firstBank =   $banks->first();
        $bankLists  = [];
        foreach ($banks as $key => $bank) {

            $bankLists[]    = [
                "color" => $bank->color,
                "id"    => $bank->id,
                "logo"  => find_image(@$bank->img),
                "name"  => $bank->name,
            ];
        }
        $mBank  = [
            "color" =>  $firstBank->color,
            "id"    =>  $firstBank->id,
            "logo"  =>  find_image($firstBank->img),
            "name"  =>  $firstBank->name,
        ];
        $bankContact    = BankContact::find($firstBank->id);
        $mContact   = [];
        if ($bankContact) {
            $mContact  = [
                "email"         => $bankContact->email,
                "phone"         => $bankContact->phone,
                "whats"         => $bankContact->whatsapp,
            ];
        }
        $bankOffers = BankOffer::where('bank_id', $firstBank->id)->get();
        $bankOfferLists  = [];
        foreach ($bankOffers as $bankOffer) {
            $bankOfferLists[]    = [
                "description_short"         => Session::get('app_locale') == 'ar' ? $bankOffer->description_ar : $bankOffer->description,
                "downPayment_percentage"    => $bankOffer->down_payment_percentage,
                "id"                        => $bankOffer->id,
                "interest_rate"             => $bankOffer->interest_rate,
                "mBank"                     => $mBank,
                "mContact"                  => $mContact,
                "number_years_installment"  => $bankOffer->number_of_years,
                "photo"                     => $bankOffer->img->name,
                "title"                     => Session::get('app_locale') == 'ar' ? $bankOffer->name_ar : $bankOffer->name,
                "valid_date"                => $bankOffer->valid_till,
            ];
        }
        return $this->returnData("bankList", $bankLists, __('Successfully'), ["featuredOfferList" => $bankOfferLists]);
    }
    public function filter(Request $request)
    {
        $this->lang($request->lang);
        $validator  = Validator::make(
            (array) $request->all(),
            [
                'bank_id'           => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $bank   = Bank::where('id', $request->bank_id)
            ->where('status', Bank::Approved)
            ->first();
        if (!$bank) {
            return $this->errorMessage(__('No such bank id exist, maybe bank id not approved yet.'));
        }
        $mBank  = [
            "color" => $bank->color,
            "id"    => $bank->id,
            "logo"  => find_image(@$bank->img),
            "name"  => $bank->name,
        ];
        $bankContact    = BankContact::find($bank->id);
        $mContact   = [];
        if ($bankContact) {
            $mContact  = [
                "email"         => $bankContact->email,
                "phone"         => $bankContact->phone,
                "whats"         => $bankContact->whatsapp,
            ];
        }
        $bankOffers = BankOffer::where('bank_id', $bank->id)->paginate();
        $bankLists  = [];
        foreach ($bankOffers as $bankOffer) {
            $bankLists[]    = [
                "description_short"         => Session::get('app_locale') == 'ar' ? $bankOffer->description_ar : $bankOffer->description,
                "downPayment_percentage"    => $bankOffer->down_payment_percentage,
                "id"                        => $bankOffer->id,
                "interest_rate"             => $bankOffer->interest_rate,
                "mBank"                     => $mBank,
                "mContact"                  => $mContact,
                "number_years_installment"  => $bankOffer->number_of_years,
                "photo"                     => $bankOffer->img->name,
                "title"                     => Session::get('app_locale') == 'ar' ? $bankOffer->name_ar : $bankOffer->name,
                "valid_date"                => $bankOffer->valid_till,
            ];
        }
        return $this->returnData("resultList", $bankLists, __('Successfully'));
    }
}
