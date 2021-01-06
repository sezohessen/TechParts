<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\CategoryDatatable;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDatatable $category)
    {

        $page_title = __('Categories');
        $page_description = __('View Categories');
        return  $category->render("dashboard.Category.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = __("Add Category");
        $page_description = __("Add new Category");

        return view('dashboard.Category.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Category::rules($request);
        $request->validate($rules);
        $credentials = Category::credentials($request);
        $Category = Category::create($credentials);

       session()->flash('created',__("Changed has been Created successfully!"));
       return redirect()->route("dashboard.category.index");
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
    public function edit($id)
    {
        $page_title = __('Category');
        $page_description = __('Edit Category');
        $category = Category::find($id);
        return view('dashboard.Category.edit', compact('page_title', 'page_description','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules =$category->rules($request);
        $request->validate($rules);
        $credentials = $category->credentials($request);
        $category->update($credentials);
        session()->flash('updated',__("Changed has been updated successfully!"));
        return  redirect()->route("dashboard.category.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.category.index");
    }
    public function Activity(Request $request){
        $category = Category::find($request->id);
        $category->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$category = Category::find($id);
				$category->delete();
			}
		} else {
			$category = Category::find(request('item'));
			$category->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.category.index");
    }
}
