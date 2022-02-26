<?php

namespace App\Http\Controllers\Api;

use App\Models\Part;
use App\Models\CarYear;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\CarClassification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PartResource;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\CarYearResource;
use App\Http\Requests\PartSearchRequest;
use App\Http\Resources\CarMakerResource;
use App\Http\Resources\CarModelResource;
use App\Http\Resources\CarCapacityResource;
use App\Http\Resources\CarClassificationCollection;

class CarModlesController extends Controller
{
    use GeneralTrait;

    public function carModels()
    {
        return  (CarMakerResource::collection(CarMaker::paginate(10)))->additional(['additional_parameters' =>
        [ 'car_capacity' => CarCapacityResource::collection(CarCapacity::get())  , 'success' => true , 'msg' => 'car_models']]);
    }

    public function searchForPart(PartSearchRequest $request)
    {
        $parts          = Part::where('active',1);

        // Normal Search
        if ($request->searchOpt == 'normal')
        {
            $parts->where(function ($query) {
                $query->where('name','like','%'.request('search').'%')
                      ->orWhere('name_ar','like','%'.request('search').'%')
                      ->orWhere('part_number','like','%'.request('search').'%');
            });
            // Order By
            if($request->order == 'desc') {
                $parts->orderBy('price','desc');
            } elseif ($request->order == 'asc') {
                $parts->orderBy('price','asc');
            } elseif ($request->order == 'views') {
                $parts->orderBy('views','desc');
            } elseif ($request->order == 'newest') {
                $parts->orderBy('id','desc');
            } elseif ($request->order == 'nearest') {
                $lat    = $request->lat;
                $long   = $request->long;
                $parts->join('sellers', 'sellers.user_id','=','parts.user_id')
                ->select(DB::raw("parts.*,
                    6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(sellers.lat))
                    * cos(radians(sellers.long) - radians(" . $long . "))
                    + sin(radians(" .$lat. "))
                    * sin(radians(sellers.lat))) AS distance
                "))
                ->orderBy('distance');}
            return (PartResource::collection($parts->paginate(10)))->additional(['status' =>
            [ 'success' => true , 'msg' => 'if data is empty it means there is no part for this ID'  ]]);

        // Advanced Search
        } elseif ($request->searchOpt == 'adv') {
            if($request->carBrand){
                $parts->whereHas('car', function($q) use($request) {
                    $q->where('cars.CarMaker_id',$request->carBrand);
                });
            }
            if($request->carType){
                $parts->whereHas('car', function($q) use($request) {
                    $q->where('cars.CarModel_id',$request->carType);
                });
            }
            if($request->carYear){
                $parts->whereHas('car', function($q) use($request) {
                    $q->where('cars.CarYear_id',$request->carYear);
                });
            }
            if($request->carCapacity){
                $parts->whereHas('car', function($q) use($request) {
                    $q->where('cars.CarCapacity_id',$request->carCapacity);
                });
            }
            // Order By
            if($request->order == 'desc') {
                $parts->orderBy('price','desc');
            } elseif ($request->order == 'asc') {
                $parts->orderBy('price','asc');
            } elseif ($request->order == 'views') {
                $parts->orderBy('views','desc');
            } elseif ($request->order == 'newest') {
                $parts->orderBy('id','desc');
            } elseif ($request->order == 'nearest') {
                $lat    = $request->lat;
                $long   = $request->long;
                $parts->join('sellers', 'sellers.user_id','=','parts.user_id')
                ->select(DB::raw("parts.*,
                    6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(sellers.lat))
                    * cos(radians(sellers.long) - radians(" . $long . "))
                    + sin(radians(" .$lat. "))
                    * sin(radians(sellers.lat))) AS distance
                "))
                ->orderBy('distance');}

            return (PartResource::collection($parts->paginate(10)))->additional(['status' =>
            [ 'success' => true , 'msg' => 'if data is empty it means there is no part for this ID'  ]]);
        }
    }


}
