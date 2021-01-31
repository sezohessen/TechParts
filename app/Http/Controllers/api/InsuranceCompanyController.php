<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Insurance;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;

class InsuranceCompanyController extends Controller
{
    use GeneralTrait;
    public function show(Request $request)
    {
        $this->lang($request->lang);
        $validator  = Validator::make((array) $request->all(), [
            'interest_country'  => 'required|integer', //Will be updated

        ]);

        if (!$validator->fails()) {
            $InsuranceCompanies = Insurance::all(); //Will be updated
            $insurances = [];
            foreach ($InsuranceCompanies as $insurance) {
                $insurances[] = [
                    "color"     => '#000000', //Will be updated
                    "id"        => $insurance->id,
                    "logo"      => find_image($insurance->img),
                    "name"      => $insurance->name_by_lang,
                ];
            }
            return $this->returnData("insuranceCompanyList", $insurances, "Successfully");
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function offer(Request $request)
    {
        $this->lang($request->lang);
        $validator  = Validator::make((array) $request->all(), [
            'interest_country'  => 'required|integer', //Will be updated
            'company_id'        => 'required|integer',

        ]);

        if (!$validator->fails()) {
            $id                 = $request->company_id;
            $InsuranceCompany   = Insurance::find($id); //Will be updated
            if ($InsuranceCompany) {
                $insurances = [];
                if ($InsuranceCompany->offers) {
                    foreach ($InsuranceCompany->offers as $offer) {
                        /* Insurance Contact */
                        $mContact = [ //Will be updated
                            "phone" => $InsuranceCompany->user->phone,
                            "whats" => $InsuranceCompany->user->whats_app
                        ];
                        /* Insurance Company */
                        $insurance  = [
                            "color"     => '#000000', //Will be updated
                            "id"        => $InsuranceCompany->id,
                            "logo"      => find_image($InsuranceCompany->img),
                            "name"      => $InsuranceCompany->name_by_lang,
                        ];
                        /* Insurance Offers's plans */
                        $offer_plan = [];
                        if ($offer->plans) {
                            foreach ($offer->plans as $plan) {
                                $offer_plan[] = [
                                    "description"   =>  $plan->description_by_lang,
                                    "id"            => $plan->id,
                                    "money"         => $plan->price,
                                    "name"          => $plan->name_by_lang,
                                ];
                            }
                        }
                        /* Insurance Offers */
                        $insurances[] = [
                            "description"   => $offer->description_by_lang,
                            "id"            => $offer->id,
                            "photo"         => find_image($offer->img),
                            "title"         => $offer->name_by_lang,
                            "mCompany"      => $insurance,
                            "mContact"      => $mContact,
                            "planList"      => $offer_plan,
                        ];
                    }
                }
                return $this->returnData("insuranceOfferList", $insurances, "Successfully");
            } else {
                return $this->errorMessage(__("No such company id found"));
            }
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function askHelp(Request $request)
    {
        $this->lang($request->lang);
        $validator  = Validator::make((array) $request->all(), [
            'message'           => 'required|min:3|max:1000',
            'name'              => 'required',
            'email'             => 'required|email',
            'phone'             => 'string',
            'interest_country'  => 'nullable|integer', //Will be updated
            //Will be updated
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
            if (@$country) {
                $ContactUs->country_phone = $country->country_phone;
                $ContactUs->save();
            }
            return $this->returnSuccess(__("Will call you back soon"));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
}
