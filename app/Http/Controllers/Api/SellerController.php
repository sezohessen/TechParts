<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    public function index()
    {
        return Seller::all();
    }

    public function addCarModel(Request $request)
    {
        // Validation
        $rules = array(
            'name'          => 'required|string|min:4|max:20|unique:car_models',
            'CarMaker_id'   => 'required|integer'
        );
        $validate = Validator::make($request->all(), $rules);
        // Return errors
        if($validate->fails())
        {
            return $validate->errors();
        }
        $CarModel = new CarModel();
        $CarModel->name         = $request->name;
        $CarModel->CarMaker_id  = $request->CarMaker_id;
        $Result = $CarModel->save();

        if($Result)
        {
            return ['Result' => 'Data Has been added'];
        } else {
            return ['Result' => 'Failed'];
        }
    }
}
