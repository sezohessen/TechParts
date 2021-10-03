<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\Seller\PartDatatable as PartTable;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\City;
use App\Models\Part;
use App\Models\PartImg;
use App\Models\User;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PartTable $part)
    {
        $page_title         = __("Parts");
        $page_description   =__( "View parts");
        return  $part->render("SellerDashboard.Part.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title         = __("Add part");
        $page_description   =__( "Add New Record");
        $cars               = Car::all();
        return view('SellerDashboard.Part.add', compact('page_title', 'page_description','cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules          = Part::rules($request,NULL,$InSellerDashboard = 1);
        $request->validate($rules);
        $credentials    = Part::credentials($request,$userID = 1);
        $Part           = Part::create($credentials);
        if($request->file('part_img_new')){
            $images  = $request->file('part_img_new');
            foreach($images as $key=>$image){
                $imageID = add_Image($image,NULL,Part::base);
                PartImg::create([
                    'part_id'   => $Part->id,
                    'img_id'    => $imageID
                ]);
            }
        }
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("seller.part.index");
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
    public function edit(part $part)
    {
        if($part->user_id != Auth()->user()->id)return redirect()->route('seller.index');
        $page_title         = __("Edit Part");
        $page_description   = __("Edit");
        $cars               = Car::all();
        return view('SellerDashboard.Part.edit', compact('page_title', 'page_description','cars','part'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part)
    {
        $rules          = Part::rules($request,$image = 1,$InSellerDashboard = 1);
        $request->validate($rules);
        $credentials    = Part::credentials($request,$edit = 1);
        $part->update($credentials);
        if($request->file('part_img')){
            $images  = $request->file('part_img');
            foreach($images as $key=>$image){
                add_Image($image,$key,Part::base,$update = 1);
            }
        }
        if($request->file('part_img_new')){
            $images  = $request->file('part_img_new');
            foreach($images as $key=>$image){
                $imageID = add_Image($image,NULL,Part::base);
                PartImg::create([
                    'part_id'   => $part->id,
                    'img_id'    => $imageID
                ]);
            }
        }
        session()->flash('updated',__("Changes has been Created Successfully"));
        return redirect()->route("seller.part.index");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Activity(Request $request){
        $country = Part::find($request->id);
        $country->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function destroy(Part $part)
    {
        $part->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("seller.part.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$part = Part::find($id);
				$part->delete();
			}
		} else {
			$part = Part::find(request('item'));
			$part->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("seller.part.index");
    }
}
