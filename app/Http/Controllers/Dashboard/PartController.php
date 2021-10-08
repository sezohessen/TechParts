<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\Request;
use App\DataTables\PartDatatable;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\PartImg;
use App\Models\Seller;
use Exception;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PartDatatable $part)
    {
        $page_title = __("Parts");
        $page_description =__( "View parts");
        return  $part->render("dashboard.Part.index", compact('page_title', 'page_description'));
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
        $sellers            = Seller::all();
        return view('dashboard.Part.add', compact('page_title', 'page_description','cars','sellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules          = Part::rules($request);

        $request->validate($rules);
        $credentials    = Part::credentials($request);
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
        return redirect()->route("dashboard.part.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(part $part)
    {
        $page_title         = __("Edit Part");
        $page_description   = __("Edit");
        $cars               = Car::all();
        $sellers            = Seller::all();
        return view('dashboard.Part.edit', compact('page_title', 'page_description','cars','part','sellers'));
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

        $rules          = Part::rules($request,true);
        $request->validate($rules);

        $credentials    = Part::credentials($request,true);
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
        return redirect()->route("dashboard.part.index");
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
        return redirect()->route("dashboard.part.index");
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
        return redirect()->route("dashboard.part.index");
    }
}
