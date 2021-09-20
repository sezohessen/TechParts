<?php

namespace App\Http\Controllers\website;

use App\Models\Car;
use App\Models\Part;
use App\Models\User;
use App\Models\Seller;
use App\Models\CarModel;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CarMaker;
use App\Models\CarYear;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        // -----------Search And Sort--------------

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
       /*  if(isset($Request->carMaker)){
            $parts->where('category_id', $Request->carMaker);
        }
        if(isset($Request->subcategory_id)){
            $parts->where('subcategory_id', $Request->subcategory_id);
        }
        if(isset($Request->subcategory_id)){
            $parts->where('subcategory_id', $Request->subcategory_id);
        } */

        if(isset($Request->type)){
            $parts->where('type', $Request->type);
        }
        /* if (isset($Request->order) && $Request->order == 'desc') {
            $parts->orderBy('price','desc');
        }elseif(isset($Request->order) && $Request->order == 'asc'){
            $parts->orderBy('price','asc');
        }elseif (isset($Request->order) && $Request->order == 'views'){
            $parts->orderBy('views','desc');
        }else{
            $parts->orderBy('id', 'desc');
        } */

        $parts = $parts->paginate(12);
        /* Append Request search to product */
        $parts->appends(
            [
                /* 'order'             => $Request->order, */
                'from'              => $Request->from,
                'to'                => $Request->to,
                'search'            => $Request->search,
                'governorate_id'    => $Request->governorate_id,
                'city_id'           => $Request->city_id,
            ]
        );
        return view('website.index',compact('parts','brands','governorates'));

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
        return view('website.part',compact('part','hasReview','RelatedModelParts','reviews','partReview'));
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
