<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CarCapacity;
use App\Models\CarClassification;
use App\Models\CarMaker;
use App\Models\Governorate;
use App\Models\Part;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AllPartController extends Controller
{
    public function show(Request $Request)
    {

        $parts          = Part::where('active',1);
        $brands         = CarMaker::all();
        $governorates   = Governorate::all();
        $capacities     = CarCapacity::all();
        $Classes        = CarClassification::limit(3)->get();
        // -----------Search And Sort--------------
        if(isset($Request->order) && $Request->order == 'nearest'){
            if($Request->lat==NULL||$Request->long==NULL){
                session()->flash('location',__("Please allow website to access your location"));
                return redirect()->back();
            }
        }
        if (isset($Request->search)){
            $parts->where('name','like','%'.request('search').'%')
                  ->orWhere('name_ar','like','%'.request('search').'%');
        }
        if(isset($Request->carMaker)){
            $parts->whereHas('car', function($q) use($Request) {
                $q->where('cars.CarMaker_id',$Request->carMaker);
            });
        }
        if(isset($Request->carModel)){
            $parts->whereHas('car', function($q) use($Request) {
                $q->where('cars.CarModel_id',$Request->carModel);
            });
        }
        if(isset($Request->carYear)){
            $parts->whereHas('car', function($q) use($Request) {
                $q->where('cars.CarYear_id',$Request->carYear);
            });
        }
        if(isset($Request->carCapacity)){
            $parts->whereHas('car', function($q) use($Request) {
                $q->where('cars.CarCapacity_id',$Request->carCapacity);
            });
        }

        if (isset($Request->order) && $Request->order == 'desc') {
            $parts->orderBy('price','desc');
        }elseif(isset($Request->order) && $Request->order == 'asc'){
            $parts->orderBy('price','asc');
        }elseif (isset($Request->order) && $Request->order == 'views'){
            $parts->orderBy('views','desc');
        }elseif (isset($Request->order) && $Request->order == 'nearest'){
            $lat    = $Request->lat;
            $long   = $Request->long;
            $parts->join('sellers', 'sellers.user_id','=','parts.user_id')
            ->select(DB::raw("parts.*,
                6371 * acos(cos(radians(" . $lat . "))
                * cos(radians(sellers.lat))
                * cos(radians(sellers.long) - radians(" . $long . "))
                + sin(radians(" .$lat. "))
                * sin(radians(sellers.lat))) AS distance
            "))
            ->orderBy('distance');
            /* $parts->whereHas('seller', function($q) use($lat,$long) {
                $q->select(DB::raw("
                    6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(sellers.lat))
                    * cos(radians(sellers.long) - radians(" . $long . "))
                    + sin(radians(" .$lat. "))
                    * sin(radians(sellers.lat))) AS distance
                "));
            }); */
            /* Here I faced problem
                **Summary**
                I need to order by distance(Aliases in MySql) but distance column not found
                and you cant use orderBy in whereHas so you need to make it manually by joining two tables
                and order by the aliase one
            */
        }else{
            $parts->orderBy('id', 'desc');
        }
        $parts = $parts->paginate(12);
        $totalParts = $parts->total();
        /* Append Request search to product */
        $parts->appends(
            [
                'order'             => $Request->order,
                'lat'               => $Request->lat,
                'long'              => $Request->long,
                'carMaker'          => $Request->carMaker,
                'carModel'          => $Request->carModel,
                'carYear'           => $Request->carYear,
                'carCapacity'       => $Request->carCapacity,
                'search'            => $Request->search
            ]
        );

        // Featured Parts Deals

        $deals = Part::where('active', 1)->leftJoin('reviews', 'reviews.part_id', '=', 'parts.id')
        ->select('parts.*', DB::raw('AVG(rating) as rating_average' ))->groupBy('id')->orderBy('rating_average', 'DESC')->limit(12)->get();

        return view('website.parts',compact('parts','brands','governorates','capacities','totalParts'
        ,'deals','Classes'));

    }
}
