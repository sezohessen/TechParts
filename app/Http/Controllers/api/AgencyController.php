<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\AgencyReview;
use App\Models\AskExpert;
use Illuminate\Support\Facades\Response;
use App\Models\News;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;
use App\Classes\Responseobject;

class AgencyController extends Controller
{
    use GeneralTrait;
    public function review(Request $request)
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
            'rate'          => 'in:1,2,3,4,5',
            'price_type'    => 'in:1,2,3',
            'comment'       => 'required|min:3|max:1000',
            'center_id'     => 'required|integer',
            'token'         => 'nullable'
        ]);
        if (!$validator->fails()) {
            $agency     = Agency::find($request->center_id);
            if (!$agency) {
                return $this->errorMessage(__("No such Center id exist"));
            }
            $askExpert  = AgencyReview::create([
                'rate'          => $request->rate,
                'price'         => $request->price_type,
                'review'        => $request->comment,
                'agency_id'     => $request->center_id,
            ]);
            if ($request->token) {
                $askExpert->user_id = auth()->user();
                $askExpert->save();
            }
            return $this->returnSuccess(__("Your Review Have been created Successfully, Wait for Admin to Apply your review"));
        } else {
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
}
