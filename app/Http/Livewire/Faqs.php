<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Faq;
class Faqs extends Component
{
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
    public function render()
    {
        return view('livewire.faqs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function store(Request $request)
    {
       $data=$this->validate();
       $faq=Faq::create($data);
       session()->flash('success',__("faqs__create_success"));
       return redirect()->route("faqs.index");

    }

}
