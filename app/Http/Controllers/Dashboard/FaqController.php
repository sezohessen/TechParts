<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $propertyName;
    public $question;
    public $question_ar;
    public $answer;
    public $answer_ar;
    protected $rules=[
        'question'       => 'required|min:3|max:1000',
        'question_ar'    => 'required|min:3|max:1000',
        'answer'         => 'required|min:3|max:1000',
        'answer_ar'      => 'required|min:3|max:1000',
    ];
    public function index()
    {

        $page_title = __('faqs FAQS');
        $page_description =__('faqs description');

        return view('dashboard.FAQS.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        App::setLocale('ar');
        $page_title =__('faqs__create_FAQS');
        $page_description =  __('faqs__create_description');

        return view('dashboard.FAQS.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            'question'       => 'required|min:3|max:1000',
            'question_ar'    => 'required|min:3|max:1000',
            'answer'         => 'required|min:3|max:1000',
            'answer_ar'      => 'required|min:3|max:1000',
        ]);
    }
    public function store(Request $request)
    {
       $this->validate($request,[
        'question'       => 'required|min:3|max:1000',
        'question_ar'    => 'required|min:3|max:1000',
        'answer'         => 'required|min:3|max:1000',
        'answer_ar'      => 'required|min:3|max:1000',
       ]);

       $faq=Faq::create();
       session()->flash('success',__("faqs__create_success"));
       return redirect()->route("faqs.index");

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
