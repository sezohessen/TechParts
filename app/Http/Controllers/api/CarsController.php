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
use App\Models\car_deposit;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator as Validator;

use function PHPSTORM_META\type;

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
class DataType {
    const single = 0;
    const list = 1;
    const compare = 2;
}
class CarsController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function failed($validator)
    {
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
    public function Validator($request,$rules,$niceNames=[])
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
        return Validator::make($request->all(),$rules,[],$niceNames);
    }
    public function details(Request $request)
    {

        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car not found');
            }
            $type   = new DataType();
            $data=(new CarResource($car))->type($type::single);
            return  $this->returnData('mCar',$data,__('Successfully'));
        }else {
            return $this->failed($validator);
        }

    }


    public function search(Request $request)
    {

        $validator=$this->Validator($request,[
            "interest_country" => 'required|string|max:255',
            "car_status"       => 'required|string|max:255|in:Used,New,مستعملة,جديدة',
            "word"             => 'required|string|max:255',
        ]);
        if (!$validator->fails()) {
            if(session()->get('app_locale')=="ar")
                $status=(($request->car_status=="جديدة") ? Car::IS_NEW : Car::IS_USED);
            else {
                $status=(($request->car_status=="New") ? Car::IS_NEW : Car::IS_USED);
            }
            $type   = new DataType();
            $data=(new CarCollection(
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
            ))->type(2);
            return $data;
        }else {
            return $this->failed($validator);
        }
    }
    public function deposit(Request $request)
    {

        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
            "price"             => 'required|integer',
            "weaccept_order_id" => 'required|integer',
        ],[
            'weaccept_order_id' => __('Order ID'),
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car not found');
            }
            car_deposit::create([
                'user_id'=> Auth()->user()->id,
                'car_id'=> $car->id,
                'price'=> $request->price,
                'weaccept_order_id'=> $request->weaccept_order_id
            ]);
            $type   = new DataType();
            $data=(new CarResource($car))->type($type::single);
            return  $this->returnData('mCar',$data,__('Deposit Successfully'));

        }else {
            return $this->failed($validator);
        }
    }
    public function alert(Request $request)
    {
        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
            "status"             => 'required|integer|between:0,1',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car not found');
            }
            $car->update(["status"=>$request->status]);
            return  $this->returnSuccess(__('Success change Status of car'));

        }else {
            return $this->failed($validator);
        }
    }
    public function compare(Request $request)
    {
        $validator=$this->Validator($request,[
            "car_id_01"            => 'required|integer',
            "car_id_02"             => 'required|integer|different:car_id_01',
        ],[
            'car_id_01' => __('First Car ID'),
            'car_id_02' => __('Second Car ID'),
        ]);
        if (!$validator->fails()) {
            if(!$first_car=Car::find($request->car_id_01)){
                return $this->errorMessage('First Car ID not found');
            }
            if(!$second_car=Car::find($request->car_id_02)){
                return $this->errorMessage('Second Car ID not found');
            }
            $type   = new DataType();
            $data=(new CarCollection(Car::find([$request->car_id_01,$request->car_id_02])));//->type($type::compare);
            return  $this->returnData('carList',$data->collection,__('Successfully'));

        }else {
            return $this->failed($validator);
        }
    }


}
