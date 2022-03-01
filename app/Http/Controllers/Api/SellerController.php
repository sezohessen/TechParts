<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Models\Part;
use App\Models\CarYear;
use App\Models\PartImg;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartRequest;
use App\Http\Resources\CarYearResource;
use App\Http\Resources\CarMakerResource;
use App\Http\Resources\CarModelResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CarCapacityResource;
use App\Http\Resources\PartResource;

class SellerController extends Controller
{
    use GeneralTrait;

    public function addCarType(Request $request)
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
        if( CarMaker::where('id', $request->CarMaker_id)->first()->id == $request->CarMaker_id )
        {
            $credentials = CarModel::credentials($request);
            $CarModel    = CarModel::create($credentials);
            return $this->returnData('data', new CarModelResource($CarModel),'Car type has been created.');
        } else {
            return $this->returnError('failed ' . $request->CarMaker_id . ' ID Not found' );
        }
    }

    public function addYear(Request $request)
    {
        // Validation
        $rules = array(
            'year'          => 'required|string|min:4|max:20|',
            'CarModel_id'   => 'required|integer'
        );
        $validate = Validator::make($request->all(), $rules);
        // Return errors
        if($validate->fails())
        {
            return $validate->errors();
        }
        if( CarModel::where('id', $request->CarModel_id)->first() != null)
        {
            if(CarYear::where('CarModel_id',$request->CarModel_id)->where('year',$request->year)->first() == null)
            {
                $credentials = CarYear::credentials($request);
                $CarYear    = CarYear::create($credentials);
                return $this->returnData('data', new CarYearResource($CarYear),'Car year has been created.');
            } else {
                return $this->returnError('failed Car year exits on this model' );
            }

        } else {
            return $this->returnError('failed ' . $request->CarModel_id . ' ID Not found' );
        }
    }

    public function addCapacity(Request $request)
    {
        // Validation
        $rules = array(
            'capacity'             => 'required|string|max:255',
        );
        $validate = Validator::make($request->all(), $rules);
        // Return errors
        if($validate->fails())
        {
            return $validate->errors();
        }
        if(CarCapacity::where('capacity', $request->capacity)->first() == null)
        {
            $credentials = CarCapacity::credentials($request);
            $CarCapacity    = CarCapacity::create($credentials);
            return $this->returnData('data', new CarCapacityResource($CarCapacity),'Car Capacity has been created.');
        } else {
            return $this->returnError('failed Car Capacity exits' );
        }


    }

    public function addPart(StorePartRequest $request)
    {
        // Make new car
        $newCar = new Car;
        $newCar->user_id     = auth()->user()->id;
        $newCar->CarModel_id = $request->CarModel_id;
        $newCar->CarMaker_id = $request->CarMaker_id;
        $newCar->CarYear_id  = $request->CarYear_id;
        $newCar->CarCapacity_id = $request->CarCapacity_id;
        $newCar->save();
        $credentials         = Part::credentials($request,auth()->user()->id,$newCar->id);
        $Part                = Part::create($credentials);
        if($request->file('part_img_one')){
            $image = $request->file('part_img_one');
            $imageID = add_Image($image,NULL,Part::base);
            PartImg::create([
                'part_id'   => $Part->id,
                'img_id'    => $imageID
            ]);
        }
        if($request->file('part_img_two')){
            $image = $request->file('part_img_two');
            $imageID = add_Image($image,NULL,Part::base);
            PartImg::create([
                'part_id'   => $Part->id,
                'img_id'    => $imageID
            ]);
        }
        if($request->file('part_img_three')){
            $image = $request->file('part_img_three');
            $imageID = add_Image($image,NULL,Part::base);
            PartImg::create([
                'part_id'   => $Part->id,
                'img_id'    => $imageID
            ]);
        }
        if($request->file('part_img_four')){
            $image = $request->file('part_img_four');
            $imageID = add_Image($image,NULL,Part::base);
            PartImg::create([
                'part_id'   => $Part->id,
                'img_id'    => $imageID
            ]);
        }
        return $this->returnData('data', new PartResource($Part),'Part has been created.');

    }
}
