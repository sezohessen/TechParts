<?php

namespace App\Http\Controllers\Website;


use App\Models\Part;

use App\Models\CarModel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CarCapacity;
use App\Models\CarClassification;
use App\Models\CarMaker;
use App\Models\CarYear;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Review;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $Request)
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
            if(Session::get('app_locale')=='en')$parts->where('name','like','%'.request('search').'%');
            else $parts->where('name_ar','like','%'.request('search').'%');
        }
        if(isset($Request->from) && isset($Request->to)){
            $parts->whereBetween('price', [$Request->from, $Request->to]);
        }
        if(isset($Request->governorate_id)){
            $parts->whereHas('seller', function($q) use($Request) {
                $q->where('sellers.governorate_id',$Request->governorate_id);
            });
        }
        if(isset($Request->city_id)){
            $parts->whereHas('seller', function($q) use($Request) {
                $q->where('sellers.city_id',$Request->city_id);
            });
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
                'from'              => $Request->from,
                'to'                => $Request->to,
                'carMaker'          => $Request->carMaker,
                'carModel'          => $Request->carModel,
                'carYear'           => $Request->carYear,
                'carCapacity'       => $Request->carCapacity,
                'search'            => $Request->search,
                'governorate_id'    => $Request->governorate_id,
                'city_id'           => $Request->city_id,
            ]
        );

        // Featured Parts Deals
        $isExistReviews = Review::all();
        if($isExistReviews->count()>=5){
            $deals = Part::where('active', 1)->leftJoin('reviews', 'reviews.part_id', '=', 'parts.id')
            ->select('parts.*', DB::raw('AVG(rating) as rating_average' ))->groupBy('id')->orderBy('rating_average', 'DESC')->limit(6)->get();
        }else{
            $deals = $isExistReviews;
        }
        return view('website.index',compact('parts','brands','governorates','capacities','totalParts'
        ,'deals','Classes'));

    }
    public function getPosition(Request $request)
    {
        return [$request->latitude,$request->longitude];
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
    public function show($id)
    {
        $page_title = __('Part');

        $part         = Part::where('id', $id)
        ->where('active',1)
        ->first();

        // Show reviews
        $reviews = Review::where('part_id',$id)->get();
        if($part){
        $partReview = Review::where('part_id',$id)
        ->get()
        ->first();
        $hasReview = Review::NotLogin;
        if(Auth::check())$hasReview    = Review::where('user_id', Auth()->user()->id)->where('part_id',$id)->first() ? Review::HasReview:Review::HasNotReview;

        $carModelID    = $part->car->model->id;
        $RelatedModelParts = Part::whereHas('car', function($q) use($carModelID) {
            $q->where('cars.carModel_id',$carModelID);
        })
        ->where('id','!=',$id)
        ->where('active',1)
        ->limit(12)
        ->get();
        $partId = 'part_'.$part->id;
        if(!Session::has($partId)){
            $part->increment('views');
            Session::put($partId, 1);
        }
        $reviewCount    = Review::where('part_id',$id)
        ->get()
        ->count();
        return view('website.part',compact('part','hasReview','RelatedModelParts','reviews','partReview','page_title','reviewCount'));
        }
        else return redirect()->route('Website.Index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function available_cities($id)
    {
        $cities = City::where('governorate_id', $id)->get();
        if($cities->count() > 0 ){
            return response()->json([
                'cities' => $cities
            ]);
        }
        return response()->json([
            'cities' => null
        ]);

    }
    public function available_model($id){
        $models = CarModel::where('CarMaker_id', $id)->get();
        if($models->count() > 0 ){
            return response()->json([
                'models' => $models
            ]);
        }
        return response()->json([
                'models' => null
        ]);
    }
    public function available_year($id){
        $years = CarYear::where('CarModel_id', $id)->get();
        if($years->count() > 0 ){
            return response()->json([
                'years' => $years
            ]);
        }
        return response()->json([
                'years' => null
        ]);
    }
}
