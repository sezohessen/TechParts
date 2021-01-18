<?php

namespace App\Http\Controllers\api;

use App\Models\Car;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator as Validator;

class Responseobject
{
    const status_ok = true;
    const status_failed = false;
    const code_ok = 200;
    const code_failed = 400;
    const code_unauthorized = 403;
    const code_not_found = 404;
    const code_error = 500;
    public $status;
    public $code;
    public $msg = array();
}
class CarsController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {
        return 1;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        $validator  = Validator::make($request->all(), [
            'car_id'           => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car not found');
            }
            $data=(new CarResource($car))->unset(true);
            return  $this->returnData('mCar',$data,__('Successfully'));
        }else {
            $response   = new Responseobject();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function search(Request $request)
    {

        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        $validator  = Validator::make($request->all(), [
            "interest_country" => 'required|string|max:255',
            "car_status"       => 'required|string|max:255|in:Used,New,مستعملة,جديدة',
            "word"             => 'required|string|max:255',
        ]);
        if (!$validator->fails()) {
            if(session()->get('app_locale')=="ar")
                $status=(($request->car_status=="جديدة") ? Car::STATUS_NEW : Car::STATUS_USED);
            else {
                $status=(($request->car_status=="New") ? Car::STATUS_NEW : Car::STATUS_USED);
            }
            $data=new CarCollection(
                Car::whereHas('country', function ($query)use($request) {
                    return (session()->get('app_locale')=="ar")?
                    $query->where('name_ar', 'LIKE', $request->interest_country)
                        :
                    $query->where('name', 'LIKE', $request->interest_country);

                })
                ->orWhereHas('maker', function($query)use($request){
                    $query->where('name','LIKE',$request->word);
                })
                ->orWhere('status', '=', $status)
                ->paginate(10)
            );
            return $data;
        }else {
            $response   = new Responseobject();
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
