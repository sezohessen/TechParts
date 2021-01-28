<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Finance_request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator as Validator;
use App\Classes\Responseobject;

class InsuranceRequestController extends Controller
{
    use GeneralTrait;

    public function insurance(Request $request)
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
            'interest_country'              => 'required|integer', //Will be updated
            'token'                         => 'required',
            'car_id'                        => 'required|integer',
            'car_modelId'                   => 'required|integer',
            'car_makerId'                   => 'required|integer',
            'bank_name'                     => 'nullable',
            'is_employed'                   => 'boolean',
            'is_salary_taken_by_bank'       => 'boolean',
            'salary'                        => 'integer',
            "is_ever_paid_loan"             => 'boolean',
            "ammount_have_existing_loans"   => 'nullable|integer',
            "bank_name__credit_card"        => 'nullable|alpha',
        ]);
        if (!$validator->fails()) {
            $Finance_request = Finance_request::create([
                'car_id'                => $request->car_id,
                'car_modelId'           => $request->car_modelId,
                'car_makerId'           => $request->car_makerId,
                'user_id'               => auth()->user()->id,
                'self_employed'         => $request->is_employed,
                'salary_through_bank'   => $request->is_salary_taken_by_bank,
                'monthly_salary'        => $request->salary,
                "paid_loan"             => $request->is_ever_paid_loan,
                "existing_loans"        => $request->ammount_have_existing_loans ? true : false,
                "provide_amount"        => $request->ammount_have_existing_loans ? $request->ammount_have_existing_loans : NULL,
                'existing_credit'       => $request->bank_name__credit_card ? true : false,
                'bank_name'             => $request->bank_name__credit_card ? $request->bank_name__credit_card : NULL,
                'status'                => 'Pending'
            ]);

            return $this->returnSuccess(__("Successfully Create Request"));
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
