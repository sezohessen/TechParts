<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Car;
use App\Models\Trending;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TrendCar;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Trend\Trend;
use App\DataTables\TrendingCarDatatable;
class TrendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrendingCarDatatable $trending)
    {
        $page_title = __("Trending");
        $page_description = __("view Trends");
        return  $trending->render("dashboard.Trending.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Trend");
        $page_description = __("Add Trend");
        $cars=Car::where("status",1)->get();
        return view('dashboard.Trending.add', compact('page_title', 'page_description',"cars"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules  = Trending::rules($request);
        $request->validate($rules);
        $trend  = Trending::where('day',date("Y-m-d", strtotime($request->day)))->get();
        if($trend->count()){
            session()->flash('failed',__("This day already exist as a trend day"));
            return  redirect()->back();
        }
        $credentials = Trending::credentials($request);
        $trend=Trending::create($credentials);
        foreach($request->car_id as $car)
        {
            TrendCar::create([
                "car_id"=>$car,
                "trend_id"=>$trend->id
            ]);
        }

        session()->flash('created',__("Changes has been Created Successfully"));
        return  redirect()->route("dashboard.trending.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trending $trending)
    {
        $page_title = __("Edit Trend");
        $page_description = __("Edit Trend");
        $cars=Car::where("status",1)->get();
        $car_select=[];
        foreach($trending->trends as $item){
            $car_select[]=$item->id;
        }
        return view('dashboard.Trending.edit', compact('page_title', 'page_description',"cars","trending","car_select"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Trending $trending)
    {

        $rules = Trending::rules($request);
        $request->validate($rules);
        $ValidDay   = Trending::where('day',date("Y-m-d", strtotime($request->day)))
        ->where('id','!=',$trending->id)
        ->get();
        if($ValidDay->count()){
            session()->flash('failed',__("This day already exist as a trend day"));
            return  redirect()->back();
        }
        $credentials    = Trending::credentials($request);
        $CarDay         = Trending::where('id',$trending->id)->update($credentials);
        /* Update Trending News */
        $TrendingNews    = TrendCar::where('trend_id',$trending->id)->get();
        $SelectedNews = [];
        foreach($TrendingNews as $car){
            $SelectedNews[] = $car->car_id;
        }
        $NeedToBeDeleted = array_diff($SelectedNews,$request->car_id);
        $NeedToBeCreated = array_diff($request->car_id,$SelectedNews);

        $rules          = TrendCar::rules($request);
        $request->validate($rules);

        foreach ($NeedToBeCreated as $car){
            $credentials    = TrendCar::credentials($car,$trending->id);
            $TrendingNews   = TrendCar::create($credentials);
        }
        foreach ($NeedToBeDeleted as $car){
            $TrendingNews      = TrendCar::where([
                ['car_id',$car],
                ['trend_id',$trending->id]
            ])->delete();
        }
        session()->flash('created',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.trending.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trending $trending)
    {
        $trending->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.trending.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
                $trending = Trending::find($id);
                if($trending)
				    $trending->delete();
			}
		} else {
            $trending = Trending::find(request('item'));
            if($trending)
			    $trending->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.trending.index");
    }
}
