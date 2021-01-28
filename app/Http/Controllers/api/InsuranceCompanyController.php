<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\offer_plan;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator as Validator;
use App\Classes\Responseobject;

class InsuranceCompanyController extends Controller
{
    use GeneralTrait;
    public function show(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en'])) {
                default_lang($locale);
            } else {
                default_lang();
            }
        } else {
            default_lang();
        }
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer', //Will be updated
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $InsuranceCompanies = Insurance::all(); //Will be updated
            $insurances = [];
            foreach ($InsuranceCompanies as $insurance) {
                $insurances[] = [
                    "color"     => '#000000', //Will be updated
                    "id"        => $insurance->id,
                    "logo"      => $insurance->img->name,
                    "name"      => Session::get('app_locale') == 'ar' ? $insurance->name_ar : $insurance->name,
                ];
            }
            return $this->returnData("insuranceCompanyList", $insurances, "Successfully");
        } else {
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->msg, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function offer(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en'])) {
                default_lang($locale);
            } else {
                default_lang();
            }
        } else {
            default_lang();
        }
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer', //Will be updated
            'company_id'        => 'required|integer',
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $id                 = $request->company_id;
            $InsuranceCompany   = Insurance::find($id); //Will be updated
            $InsuranceOffers    = Insurance_offer::where('insurance_id', $id)->get();
            if ($InsuranceCompany) {
                $insurances = [];
                foreach ($InsuranceOffers as $offer) {
                    /* Insurance Contact */
                    $mContact = [ //Will be updated
                        "phone" => $InsuranceCompany->user->phone,
                        "whats" => $InsuranceCompany->user->whats_app
                    ];
                    /* Insurance Company */
                    $insurance  = [
                        "color"     => '#000000', //Will be updated
                        "id"        => $InsuranceCompany->id,
                        "logo"      => $InsuranceCompany->img->name,
                        "name"      => Session::get('app_locale') == 'ar' ? $InsuranceCompany->name_ar : $InsuranceCompany->name,
                    ];
                    /* Insurance Offers's plans */
                    $offer_plans    = offer_plan::where("offer_id", $offer->id)->get();
                    $offer_plan = [];
                    foreach ($offer_plans as $plan) {
                        $offer_plan[] = [
                            "description"   => Session::get('app_locale') == 'ar' ? $plan->description_ar : $plan->description,
                            "id"            => $plan->id,
                            "money"         => $plan->price,
                            "name"          => Session::get('app_locale') == 'ar' ? $plan->title_ar : $plan->title,
                        ];
                    }
                    /* Insurance Offers */
                    $insurances[] = [
                        "description"   => Session::get('app_locale') == 'ar' ? $offer->description_ar : $offer->description,
                        "id"            => $offer->id,
                        "photo"         => $offer->img->name,
                        "title"         => Session::get('app_locale') == 'ar' ? $offer->title_ar : $offer->title,
                        "mCompany"      => $insurance,
                        "mContact"      => $mContact,
                        "planList"      => $offer_plan,
                    ];
                }
                return $this->returnData("insuranceOfferList", $insurances, "Successfully");
            } else {
                return $this->errorMessage(__("No such company id found"));
            }
        } else {
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->msg, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function askHelp(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en'])) {
                default_lang($locale);
            } else {
                default_lang();
            }
        } else {
            default_lang();
        }
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'message'           => 'required|min:3|max:1000',
            'name'              => 'required',
            'email'             => 'required|email',
            'phone'             => 'string',
            'interest_country'  => 'nullable|integer', //Will be updated
            'token'             => 'nullable', //Will be updated
        ]);

        if (!$validator->fails()) {
            if ($request->interest_country) {
                $country    = Country::find($request->interest_country);
                if (!$country) {
                    return $this->errorMessage(__('Not found Country id'));
                }
            }
            $ContactUs = ContactUs::create([
                'message'       => $request->message,
                'email'         => $request->email,
                'phone'         => $request->phone,
            ]);
            if ($country) {
                $ContactUs->country_phone = $country->country_phone;
                $ContactUs->save();
            }
            return $this->returnSuccess(__("Will call you back soon"));
        } else {
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->msg, $item);
            }
            return Response::json(
                $response
            );
        }
    }
}
