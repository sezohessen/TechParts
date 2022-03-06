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
use App\Http\Resources\PartResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePartRequest;
use App\Http\Resources\CarYearResource;
use App\Http\Requests\UpdatePartRequest;
use App\Http\Resources\CarMakerResource;
use App\Http\Resources\CarModelResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CarCapacityResource;

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
        $newCar->CarMaker_id = $request->CarMaker_id;
        $newCar->CarModel_id = $request->CarModel_id;
        $newCar->CarYear_id  = $request->CarYear_id;
        $newCar->CarCapacity_id = $request->CarCapacity_id;
        $CarModelInCarMaker = CarModel::where([
            ['CarMaker_id',$request->CarMaker_id],
            ['id',$request->CarModel_id]])->first();
        if($CarModelInCarMaker)
        {
            $newCar->save();
            $credentials         = Part::credentials($request,auth()->user()->id,$newCar->id);
            $Part                = Part::create($credentials);
            if($request->part_img_new){
                $images  = $request->part_img_new;
                foreach($images as $key=>$image){
                    $added_images = PartImg::where('part_id',$Part->id)->get()->count();
                    if($added_images < 4)
                    {
                        $imageID = add_Image($image,NULL,Part::base);
                        PartImg::create([
                            'part_id'   => $Part->id,
                            'img_id'    => $imageID
                        ]);
                    } else {
                        return $this->returnError('Images cant be more than 4' );
                    }
                }
            }
            return $this->returnData('data', new PartResource($Part),'Part has been created.');
        } else {
            return $this->returnError('This Car model ' . $request->CarModel_id . ' is not in car Car Maker ' . $request->CarMaker_id );

        }

    }

    public function editPart(UpdatePartRequest $request)
    {
        $Part = Part::where('user_id', auth()->user()->id)->where('id', $request->part_id)->first();
        if($Part)
        {   // Update Car
            $CarId = $Part->car->id;
            $CarModelInCarMaker = CarModel::where([
                ['CarMaker_id',$request->CarMaker_id],
                ['id',$request->CarModel_id]])->first();
            if($CarModelInCarMaker)
            {
                $updateCar = Car::where('id',$CarId)->get()->first()->update([
                    'CarModel_id'    => $request->CarModel_id,
                    'CarMaker_id'    => $request->CarMaker_id,
                    'CarYear_id'     => $request->CarYear_id,
                    'CarCapacity_id' => $request->CarCapacity_id,
                ]);
                $credentials    = Part::credentials($request,auth()->user()->id,$CarId);
                $Part->update($credentials);
                // Images
                $Part_images_count = PartImg::where('part_id',$request->part_id)->get()->count();
                // Delete images
                if($request->deleted_img)
                {
                    if($Part_images_count > 1)
                    {
                        $deleted_images = PartImg::where('part_id',$request->part_id)->get();
                        $Selected_images  = [];
                        foreach($deleted_images as $deleted_image){
                            $Selected_images[] = $deleted_image->id;
                        }
                        $arrayImages = array_map('intval', explode(',', $request->deleted_img));
                        if($arrayImages)
                        {
                            foreach ($arrayImages as $deleted){
                                $image_path    = public_path() . '/' . $deleted_image->image->base . $deleted_image->image->name;
                                // Delete image
                                unlink($image_path);
                                $deleted_image->image->delete();
                                $deleted_image->delete();
                                PartImg::where([
                                    ['part_id',$request->part_id],
                                    ['id', $deleted]
                                ])->delete();
                            }
                        }
                    } else {
                        return $this->returnError('Images cant be less  than 1 you cant delete this image with ID ' . $request->deleted_img );
                    }
                }
                // End Deleting Imgaes
                if($request->part_img_new)
                {
                    // Add imgaes
                    if($Part_images_count < 4)
                    {
                        if($request->part_img_new){
                            $images  = $request->part_img_new;
                            foreach($images as $key=>$image){
                                if($Part_images_count + $key < 4)
                                {
                                    $imageID = add_Image($image,NULL,Part::base);
                                    PartImg::create([
                                        'part_id'   => $Part->id,
                                        'img_id'    => $imageID
                                    ]);
                                } else {
                                    return $this->returnError('Images cant be more than 4' );
                                }
                            }
                        }
                    } else {
                        return $this->returnError('Images cant be more than ' . $Part_images_count . ' or less than 1' );
                    }
                }
                // End adding images
                return $this->returnData('data', new PartResource($Part),'Part has been updated.');
            } else {
                return $this->returnError('This Car model ' . $request->CarModel_id . ' is not in car Car Maker ' . $request->CarMaker_id );
            }
        // If part id doesn't == request id [Error]
        } else {
            return $this->returnError('auth user doest have Part with this ID ' . $request->part_id);
        }
    }

    public function showSellerPart()
    {
        if(Auth::user())
        {
            $sellerParts = Part::where('user_id', auth()->user()->id)->paginate(10);
            return (PartResource::collection($sellerParts))->additional(['additional_parameters' =>
            ['success' => true , 'msg' => 'seller parts.']
            ]);
        }
    }

    public function deleteSellerPart(Request $request)
    {
        // Validation
        $rules = array(
            'part_id'             => 'required',
        );
        $validate = Validator::make($request->all(), $rules);
        // Return errors
        if($validate->fails())
        {
            return $validate->errors();
        }
        $deleted_part = Part::where([
            ['id', $request->part_id],
            ['user_id', auth()->user()->id]
        ])->first();
        if($deleted_part)
        {
            $deleted_images = PartImg::where('part_id',$request->part_id)->get();
            foreach ($deleted_images as $deleted_image)
            {
                $image_path    = public_path() . '/' . $deleted_image->image->base . $deleted_image->image->name;
                // Delete image
                unlink($image_path);
                $deleted_image->image->delete();
                $deleted_image->delete();
            }

            // Delete Part
            $deleted_part->delete();
            return $this->SuccessMessage('Part has been deleted.');
        } else {
            return $this->returnError('there is no part with the ID ' . $request->part_id );

        }
    }


}
